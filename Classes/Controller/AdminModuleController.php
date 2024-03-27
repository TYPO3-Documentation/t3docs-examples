<?php

/*
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

namespace T3docs\Examples\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Attribute\AsController;
use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Localization\LanguageService;

#[AsController]
final readonly class AdminModuleController
{
    public function __construct(
        protected ModuleTemplateFactory $moduleTemplateFactory,
        protected IconFactory $iconFactory,
        // ...
    ) {}

    public function handleRequest(ServerRequestInterface $request): ResponseInterface
    {
        $languageService = $this->getLanguageService();

        $allowedOptions = [
            'function' => [
                'debug' => htmlspecialchars(
                    $languageService->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang.xlf:debug'),
                ),
                'password' => htmlspecialchars(
                    $languageService->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang.xlf:password'),
                ),
                'index' => htmlspecialchars(
                    $languageService->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang.xlf:index'),
                ),
            ],
        ];

        $moduleData = $request->getAttribute('moduleData');
        if ($moduleData->cleanUp($allowedOptions)) {
            $this->getBackendUser()->pushModuleData($moduleData->getModuleIdentifier(), $moduleData->toArray());
        }

        $moduleTemplate = $this->moduleTemplateFactory->create($request);
        $this->setUpDocHeader($request, $moduleTemplate);

        $title = $languageService->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang_mod.xlf:mlang_tabs_tab');
        switch ($moduleData->get('function')) {
            case 'debug':
                $moduleTemplate->setTitle(
                    $title,
                    $languageService->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang.xlf:module.menu.debug'),
                );
                return $this->debugAction($request, $moduleTemplate);
            case 'password':
                $moduleTemplate->setTitle(
                    $title,
                    $languageService->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang.xlf:module.menu.password'),
                );
                return $this->passwordAction($request, $moduleTemplate);
            default:
                $moduleTemplate->setTitle(
                    $title,
                    $languageService->sL('LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang.xlf:module.menu.log'),
                );
                return $this->indexAction($request, $moduleTemplate);
        }
    }

    private function setUpDocHeader(
        ServerRequestInterface $request,
        ModuleTemplate $view,
    ) {
        $buttonBar = $view->getDocHeaderComponent()->getButtonBar();
        $list = $buttonBar->makeLinkButton()
            ->setHref('<uri-builder-path>')
            ->setTitle('A Title')
            ->setShowLabelText(true)
            ->setIcon($this->iconFactory->getIcon('actions-extension-import', Icon::SIZE_SMALL));
        $buttonBar->addButton($list, ButtonBar::BUTTON_POSITION_LEFT, 1);
    }

    public function indexAction(
        ServerRequestInterface $request,
        ModuleTemplate $view,
    ): ResponseInterface {
        $view->assign('aVariable', 'aValue');
        return $view->renderResponse('AdminModule/Index');
    }

    protected function debugAction(
        ServerRequestInterface $request,
        ModuleTemplate $view,
    ): ResponseInterface {
        $cmd = $request->getParsedBody()['tx_examples_admin_examples']['cmd'] ?? 'cookies';
        switch ($cmd) {
            case 'cookies':
                $this->debugCookies();
                break;
            default:
                // do something else
        }

        $view->assignMultiple(
            [
                'cookies' => $request->getCookieParams(),
                'lastcommand' => $cmd,
            ],
        );
        return $view->renderResponse('AdminModule/Debug');
    }

    protected function passwordAction(
        ServerRequestInterface $request,
        ModuleTemplate $view,
    ): ResponseInterface {
        // TODO: Do something
        return $view->renderResponse('AdminModule/Password');
    }

    private function debugCookies()
    {
        // TODO: do something()
    }

    private function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }

    private function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }
}
