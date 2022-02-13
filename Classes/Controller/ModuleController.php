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
class ModuleController extends ActionController implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    protected int $pageUid = 0;
    protected array $exampleConfig = [];

    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        protected readonly IconFactory $iconFactory,
        protected readonly ExtensionConfiguration $extensionConfiguration,
        protected readonly PasswordHashFactory $passwordHashFactory,
        protected readonly ResourceFactory $resourceFactory,
        protected readonly FileRepository $fileRepository,
        protected readonly ConnectionPool $connectionPool,
    ) {
    }

    /**
     * Generates the action menu
     */
    protected function initializeModuleTemplate(ServerRequestInterface $request): ModuleTemplate
    {
        $menuItems = [
            'flash' => [
                'controller' => 'Module',
                'action' => 'flash',
                'label' => $this->getLanguageService()->sL('LLL:EXT:examples/Resources/Private/Language/Module/locallang.xlf:module.menu.flash'),
            ],
            'tree' => [
                'controller' => 'Module',
                'action' => 'tree',
                'label' => $this->getLanguageService()->sL('LLL:EXT:examples/Resources/Private/Language/Module/locallang.xlf:module.menu.tree'),
            ],
            'clipboard' => [
                'controller' => 'Module',
                'action' => 'clipboard',
                'label' => $this->getLanguageService()->sL('LLL:EXT:examples/Resources/Private/Language/Module/locallang.xlf:module.menu.clipboard'),
            ],
            'links' => [
                'controller' => 'Module',
                'action' => 'links',
                'label' => $this->getLanguageService()->sL('LLL:EXT:examples/Resources/Private/Language/Module/locallang.xlf:module.menu.links'),
            ],
            'fileReference' => [
                'controller' => 'Module',
                'action' => 'fileReference',
                'label' => $this->getLanguageService()->sL('LLL:EXT:examples/Resources/Private/Language/Module/locallang.xlf:module.menu.fileReference'),
            ],
        ];

        $view = $this->moduleTemplateFactory->create($request, 't3docs/examples');

        $menu = $view->getDocHeaderComponent()->getMenuRegistry()->makeMenu();
        $menu->setIdentifier('ExampleModuleMenu');

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
            $this->getLanguageService()->sL('LLL:EXT:examples/Resources/Private/Language/Module/locallang_mod.xlf:mlang_tabs_tab'),
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
        $this->pageUid = (int)($this->request->getQueryParams()['id'] ?? 0);
        $this->exampleConfig = $this->extensionConfiguration->get('examples') ?? [];
        parent::initializeAction();
    }

    /**
     * Renders the list of all possible flash messages
     *
     */
    public function flashAction(): ResponseInterface
    {

        // Issue one of each type of flash messages
        $this->addFlashMessage(
            'This is a notice message',
            'Notification',
            FlashMessage::NOTICE
        );
        $this->addFlashMessage(
            'This is an information message',
            'Information',
            FlashMessage::INFO
        );
        $this->addFlashMessage(
            'This is a success message',
            'Hooray!',
            FlashMessage::OK
        );
        $this->addFlashMessage(
            'This is a warning message',
            'Watch out',
            FlashMessage::WARNING
        );
        $this->addFlashMessage(
            '
				<p>This is an error message</p>
				<p><strong>It shows that flash messages may not contain HTML (anymore, since TYPO3 7 LTS).</strong></p>
			',
            'Whoops!',
            FlashMessage::ERROR
        );
        $this->addFlashMessage(
            'This message is forced to be NOT stored in the session by setting the fourth argument to FALSE.',
            'Success',
            FlashMessage::OK,
            false
        );
        $this->addFlashMessage('This is a simple message, by default without title and with severity OK.');
        $view = $this->initializeModuleTemplate($this->request);
        return $view->renderResponse();
    }

    /**
     * Displays a page tree
     *
     */
    public function treeAction(): ResponseInterface
    {
        // Get page record for tree starting point. May be passed as an argument.
        try {
            $startingPoint = $this->request->getArgument('page');
        } catch (\Exception $e) {
            $startingPoint = 1;
        }
        $pageRecord = BackendUtility::getRecord(
            'pages',
            $startingPoint
        );

        // Create and initialize the tree object
        /** @var $tree PageTreeView */
        $tree = GeneralUtility::makeInstance(PageTreeView::class);
        $tree->init('AND ' . $GLOBALS['BE_USER']->getPagePermsClause(1));


        if ($pageRecord) {
            $html = $this->iconFactory->getIconForRecord(
                'pages',
                $pageRecord,
                Icon::SIZE_SMALL
            )->render();
        }
        $tree->tree[] = [
            'row' => $pageRecord,
            'HTML' => $html,
        ];

        // Create the page tree, from the starting point, 2 levels deep
        $depth = 2;
        $tree->getTree(
            $startingPoint,
            $depth,
            ''
        );

        $view = $this->initializeModuleTemplate($this->request);
        // Pass the tree to the view
        $view->assign(
            'tree',
            $tree->tree
        );
        return $view->renderResponse();
    }

    /**
     * Displays the content of the clipboard
     *
     */
    public function clipboardAction(
        string $cmd = 'show'
    ): ResponseInterface
    {
        $cmd = $_POST['tx_examples_tools_examplesexamples']['cmd'];
        switch ($cmd) {
            case 'debug':
                $this->debugClipboard();
                break;
        }

        // Access files and pages content of current pad
        $currentPad = $this->getCurrentClipboard();

        $normalPad = $this->getClipboard('normal');


        $view = $this->initializeModuleTemplate($this->request); // Pass data to the view for display
        $view->assignMultiple(
            [
                'current' => $currentPad,
                'normal' => $normalPad,
            ]
        );
        return $view->renderResponse();
    }


    /**
     * Debugs the content of the clipboard
     *
     */
    protected function getClipboard(string $identifier):array
    {
        /** @var $clipboard Clipboard */
        $clipboard = GeneralUtility::makeInstance(Clipboard::class);
        // Read the clipboard content from the user session
        $clipboard->initializeClipboard();
        $clipboard->setCurrentPad($identifier);
        // Access files and pages content of current pad
        $clipboardContent = [
            'files' => $clipboard->elFromTable('_FILE'),
            'pages' => $clipboard->elFromTable('pages'),
        ];
        return $clipboardContent;
    }

    /**
     * Debugs the content of the clipboard
     *
     */
    protected function getCurrentClipboard():array
    {
        /** @var $clipboard Clipboard */
        $clipboard = GeneralUtility::makeInstance(Clipboard::class);
        // Read the clipboard content from the user session
        $clipboard->initializeClipboard();
        // Access files and pages content of current pad
        $clipboardContent = [
            'files' => $clipboard->elFromTable('_FILE'),
            'pages' => $clipboard->elFromTable('pages'),
        ];
        return $clipboardContent;
    }

    /**
     * Debugs the content of the clipboard
     *
     */
    protected function debugClipboard()
    {
        /** @var $clipboard Clipboard */
        $clipboard = GeneralUtility::makeInstance(Clipboard::class);
        // Read the clipboard content from the user session
        $clipboard->initializeClipboard();
        DebugUtility::debug($clipboard->clipData);
    }

    /**
     * Displays links to edit records.
     *
     */
    public function linksAction(): ResponseInterface
    {
        $backendUriBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Routing\UriBuilder::class);
        $uriParameters = ['edit' => ['pages' => [1 => 'edit']]];
        $editPage1Link = $backendUriBuilder->buildUriFromRoute('record_edit', $uriParameters);

        $uriParameters =
            [
                'edit' =>
                    [
                        'pages' =>
                            [
                                1 => 'edit',
                                2 => 'edit'
                            ],
                        'tx_examples_haiku' =>
                            [
                                1 => 'edit'
                            ]
                    ],
                'columnsOnly' => 'title,doktype'
            ];
        $editPagesDoktypeLink = $backendUriBuilder->buildUriFromRoute('record_edit', $uriParameters);
        $uriParameters =
            [
                'edit' =>
                    [
                        'tx_examples_haiku' =>
                            [
                                1 => 'new'
                            ]
                    ],
                'defVals' =>
                    [
                        'tx_examples_haiku' =>
                            [
                                'title' => 'New Haiku?',
                                'season' => 'Spring'
                            ]
                    ],
                'columnsOnly' => 'title,season,color'
            ];
        $createHaikuLink = $backendUriBuilder->buildUriFromRoute('record_edit', $uriParameters);

        $view = $this->initializeModuleTemplate($this->request);
        $view->assignMultiple(
            [
                'editPage1Link' => $editPage1Link,
                'editPagesDoktypeLink' => $editPagesDoktypeLink,
                'createHaikuLink' => $createHaikuLink,
            ]
        );
        return $view->renderResponse();
    }

    /**
     * Displays a form to create relations between content elements and files.
     *
     * @param int $element Uid of the just processed content element (see fileReferenceCreateAction)
     */
    public function fileReferenceAction($element = 0): ResponseInterface
    {
        // Get all non-deleted content elements (this should normally be put away in a nice, clean
        // repository class; don't do this at home).
        /** @var Connection $connection */
        $connection = $this->connectionPool->getConnectionForTable('tt_content');
        try {
            $contentElements = $connection->select(
                ['uid', 'header'],
                'tt_content',
                [] ,
                [],
                ['header' => 'ASC']
            );
        } catch (\Exception $e) {
            $contentElements = [];
        }
        // If we just handled a content element, get related data to display as a confirmation
        if ((int)$element > 0) {
            $contentElement = BackendUtility::getRecord(
                'tt_content',
                (int)$element
            );
            try {
                $fileObjects = $this->fileRepository->findByRelation(
                    'tt_content',
                    'image',
                    $element
                );
            } catch (\Exception $e) {
                $fileObjects = [];
            }
        } else {
            $contentElement = null;
            $fileObjects = [];
        }
        $view = $this->initializeModuleTemplate($this->request);
        $view->assignMultiple(
            [
                'files' => $this->fileRepository->findAll(),
                'elements' => $contentElements->fetchAllAssociative(),
                'content' => $contentElement,
                'references' => $fileObjects,
            ]
        );
        return $view->renderResponse();
    }

    /**
     * Creates a file reference and redirects to the form screen.
     *
     * @param int $file Uid of the file
     * @param int $element Uid of the content element
     */
    public function fileReferenceCreateAction($file, $element): ResponseInterface
    {
        // Early return if either item is missing
        if ((int)$file === 0 || (int)$element === 0) {
            // NOTE: there would normally a nice error Flash Message added here
            $this->redirect('fileReference');
        }
        $fileObject = $this->resourceFactory->getFileObject((int)$file);
        $contentElement = BackendUtility::getRecord(
            'tt_content',
            (int)$element
        );
        // Assemble DataHandler data
        $newId = 'NEW1234';
        $data = [];
        $data['sys_file_reference'][$newId] = [
            'table_local' => 'sys_file',
            'uid_local' => $fileObject->getUid(),
            'tablenames' => 'tt_content',
            'uid_foreign' => $contentElement['uid'],
            'fieldname' => 'image',
            'pid' => $contentElement['pid'],
        ];
        $data['tt_content'][$contentElement['uid']] = [
            'image' => $newId,
        ];
        // Get an instance of the DataHandler and process the data
        /** @var DataHandler $dataHandler */
        $dataHandler = GeneralUtility::makeInstance(DataHandler::class);
        $dataHandler->start($data, []);
        $dataHandler->process_datamap();
        // Error or success reporting
        if (count($dataHandler->errorLog) === 0) {
            $this->addFlashMessage(
                LocalizationUtility::translate(
                    'create_relation_success',
                    'examples'
                ),
                ''
            );
        } else {
            foreach ($dataHandler->errorLog as $log) {
                $this->addFlashMessage(
                    $log,
                    LocalizationUtility::translate(
                        'create_relation_error',
                        'examples'
                    ),
                    FlashMessage::ERROR
                );
            }
        }

        return
            $this->redirect(
                'fileReference',
                null,
                null,
                [
                    'element' => $contentElement['uid'],
                ]
            );
    }


    /**
     * Returns a count of entries in a table defined by a request parameter, in JSON format.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function countAction(ServerRequestInterface $request): ResponseInterface
    {
        $requestParameters = $request->getQueryParams();
        // TYPO3\CMS\Core\Database\Connection::count($item, $tableName) uses QueryBuilder internally
        // therefore it is safe to pass $tablename directly from the parameters to it.
        $tablename = $requestParameters['table'];
        /** @var Connection $connection */
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable($tablename);
        $count = $connection->count('uid', $tablename, []);
        $array = ['count' => $count];
        return new \TYPO3\CMS\Core\Http\JsonResponse($array);
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
