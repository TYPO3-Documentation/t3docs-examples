<?php
namespace T3docs\Examples\Controller;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use TYPO3\CMS\Backend\Clipboard\Clipboard;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Backend\Tree\View\PageTreeView;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Type\Bitmask\Permission;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Log\LogLevel;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Crypto\PasswordHashing\PasswordHashFactory;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

/**
 * Controller for the backend module
 *
 * @author Francois Suter (Cobweb) <francois.suter@typo3.org>
 * @package TYPO3
 * @subpackage tx_examples
 */
class AdminModuleController extends ActionController implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    protected array $exampleConfig = [];

    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        protected readonly IconFactory $iconFactory,
        protected readonly ExtensionConfiguration $extensionConfiguration,
        protected readonly PasswordHashFactory $passwordHashFactory
    ) {
    }

    /**
     * Generates the action menu
     */
    protected function initializeModuleTemplate(ServerRequestInterface $request): ModuleTemplate
    {
        $menuItems = [
            'log' => [
                'controller' => 'AdminModule',
                'action' => 'log',
                'label' => $this->getLanguageService()->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang.xlf:module.menu.log'),
            ],
            'debug' => [
                'controller' => 'AdminModule',
                'action' => 'debug',
                'label' => $this->getLanguageService()->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang.xlf:module.menu.debug'),
            ],
            'password' => [
                'controller' => 'AdminModule',
                'action' => 'password',
                'label' => $this->getLanguageService()->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang.xlf:module.menu.password'),
            ],
        ];

        $view = $this->moduleTemplateFactory->create($request, 't3docs/examples');

        $menu = $view->getDocHeaderComponent()->getMenuRegistry()->makeMenu();
        $menu->setIdentifier('ExampleAdminModuleMenu');

        $context = '';
        foreach ($menuItems as $menuItemConfig) {
            $isActive = $this->request->getControllerActionName() === $menuItemConfig['action'];
            $menuItem = $menu->makeMenuItem()
                ->setTitle($menuItemConfig['label'])
                ->setHref($this->uriBuilder->reset()->uriFor($menuItemConfig['action'], [], $menuItemConfig['controller']))
                ->setActive($isActive);
            $menu->addMenuItem($menuItem);
            if ($isActive) {
                $context = $menuItemConfig['label'];
            }
        }

        $view->getDocHeaderComponent()->getMenuRegistry()->addMenu($menu);

        $view->setTitle(
            $this->getLanguageService()->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang_mod.xlf:mlang_tabs_tab'),
            $context
        );

        $permissionClause = $this->getBackendUserAuthentication()->getPagePermsClause(Permission::PAGE_SHOW);
        $pageRecord = BackendUtility::readPageAccess($this->pageUid, $permissionClause);
        if ($pageRecord) {
            $view->getDocHeaderComponent()->setMetaInformation($pageRecord);
        }
        $view->setFlashMessageQueue($this->getFlashMessageQueue());

        return $view;
    }

    /**
     * Function will be called before every other action
     */
    protected function initializeAction()
    {
        $this->exampleConfig = $this->extensionConfiguration->get('examples') ?? [];
        parent::initializeAction();
    }

    /**
     * Creates some entries using the logging API
     * $this->logger gets set by usage of the LoggerAwareTrait
     *
     */
    public function logAction(): ResponseInterface
    {
        $this->logger->info('Everything went fine.');
        $this->logger->warning('Something went awry, check your configuration!');
        $this->logger->error(
            'This was not a good idea',
            [
                'foo' => 'bar',
                'bar' => $this,
            ]
        );
        $this->logger->log(
            LogLevel::CRITICAL,
            'This is an utter failure!'
        );
        $this->addFlashMessage(
            '3 log entries created',
            '',
            FlashMessage::INFO
        );
        $view = $this->initializeModuleTemplate($this->request);
        return $view->renderResponse();
    }

    /**
     * Displays the content of the clipboard
     *
     */
    public function debugAction(
        string $cmd = 'cookies'
    ): ResponseInterface
    {
        $cmd = $_POST['tx_examples_admin_examples']['cmd'];
        switch ($cmd) {
            case 'cookies':
                $this->debugCookies();
                break;
        }

        $view = $this->initializeModuleTemplate($this->request);
        return $view->renderResponse();
    }

    protected function debugCookies() {
        DebugUtility::debug($_COOKIE, 'cookie');
    }


    public function getPasswordHash(string $password, string $mode) : string {
        $hashInstance = $this->passwordHashFactory->getDefaultHashInstance($mode);
        return $hashInstance->getHashedPassword($password);
    }

    public function checkPassword(string $hashedPassword, string $expectedPassword, string $mode) : bool {
        $hashInstance = $this->passwordHashFactory->getDefaultHashInstance($mode);
        return $hashInstance->checkPassword($expectedPassword, $hashedPassword);
    }

    /**
     * checks or compares the password
     */
    public function passwordAction(string $passwordAction = 'get', string $password = 'joh316', string $hashedPassword = '', string $mode = 'FE'): ResponseInterface
    {
        $modes = ['FE' => 'FE', 'BE' => 'BE'];
        if ($passwordAction == 'Check') {
            $success = $this->checkPassword($hashedPassword, $password, $mode);
        } else {
            $hashedPassword = $this->getPasswordHash($password, $mode);
            $success = true;
        }
        $view = $this->initializeModuleTemplate($this->request);
        $view->assignMultiple(
            [
                'modes' => $modes,
                'mode' => $mode,
                'hashedPassword' => $hashedPassword,
                'password' => $password,
                'success' => $success,
                'passwordAction' => $passwordAction
            ]
        );
        return $view->renderResponse();
    }


    protected function getBackendUserAuthentication(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
