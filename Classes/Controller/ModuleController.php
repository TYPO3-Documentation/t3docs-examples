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
use TYPO3\CMS\Backend\Template\Components\Menu\Menu;
use TYPO3\CMS\Backend\Template\Components\Menu\MenuItem;
use TYPO3\CMS\Backend\Tree\View\PageTreeView;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendTemplateView;
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
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

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
    /**
     * @var BackendTemplateView
     */
    protected $view;

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
        return $this->htmlResponse();
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
        return $this->htmlResponse();
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

        // Create the icon for the current page and add it to the tree
        /** @var IconFactory $iconFactory */
        $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
        if ($pageRecord) {
            $html = $iconFactory->getIconForRecord(
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

        // Pass the tree to the view
        $this->view->assign(
            'tree',
            $tree->tree
        );
        return $this->htmlResponse();
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

        // Pass data to the view for display
        $this->view->assignMultiple(
            [
                'current' => $currentPad,
                'normal' => $normalPad,
            ]
        );
        return $this->htmlResponse();
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
        $this->view->assignMultiple(
            [
                'editPage1Link' => $editPage1Link,
                'editPagesDoktypeLink' => $editPagesDoktypeLink,
                'createHaikuLink' => $createHaikuLink,
            ]
        );
        return $this->htmlResponse();
    }

    /**
     * Displays a form to create relations between content elements and files.
     *
     * @param int $element Uid of the just processed content element (see fileReferenceCreateAction)
     */
    public function fileReferenceAction($element = 0): ResponseInterface
    {
        /** @var FileRepository $fileRepository */
        $fileRepository = $this->objectManager->get(FileRepository::class);
        // Get all non-deleted content elements (this should normally be put away in a nice, clean
        // repository class; don't do this at home).
        /** @var Connection $connection */
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tt_content');
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
                $fileObjects = $fileRepository->findByRelation(
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
        $this->view->assignMultiple(
            [
                'files' => $fileRepository->findAll(),
                'elements' => $contentElements,
                'content' => $contentElement,
                'references' => $fileObjects,
            ]
        );
        return $this->htmlResponse();
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
        /** @var \TYPO3\CMS\Core\Resource\ResourceFactory $resourceFactory */
        $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
        $fileObject = $resourceFactory->getFileObject((int)$file);
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

        $this->redirect(
            'fileReference',
            null,
            null,
            [
                'element' => $contentElement['uid'],
            ]
        );
        return $this->htmlResponse();
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

    /**
     * Initializes the template to use for all actions.
     *
     * @return void
     */
    protected function initializeAction()
    {
        $this->defaultViewObjectName = BackendTemplateView::class;
    }

    /**
     * Initializes the view before invoking an action method.
     *
     * @param ViewInterface $view The view to be initialized
     * @return void
     * @api
     */
    protected function initializeView(ViewInterface $view)
    {
        if ($view instanceof BackendTemplateView) {
            parent::initializeView($view);
        }
        $pageRenderer = $view->getModuleTemplate()->getPageRenderer();
        $pageRenderer->loadRequireJsModule('TYPO3/CMS/Examples/Application');
        // Make localized labels available in JavaScript context
        $pageRenderer->addInlineLanguageLabelFile('EXT:examples/Resources/Private/Language/locallang.xlf');

        // Add action menu
        /** @var Menu $menu */
        $menu = GeneralUtility::makeInstance(Menu::class);
        $menu->setIdentifier('_examplesMenu');

        /** @var UriBuilder $uriBuilder */
        $uriBuilder = $this->objectManager->get(UriBuilder::class);
        $uriBuilder->setRequest($this->request);

        // Add menu items
        /** @var MenuItem $menuItem */
        $menuItem = GeneralUtility::makeInstance(MenuItem::class);
        $items = ['flash', 'log', 'tree', 'clipboard', 'links', 'fileReference'];

        foreach ($items as $item) {
            $isActive = $this->actionMethodName === $item . 'Action';
            $menuItem->setTitle(
                LocalizationUtility::translate(
                    'function_' . $item,
                    'examples'
                )
            );
            $uri = $uriBuilder->reset()->uriFor(
                $item,
                [],
                'Module'
            );
            $menuItem->setActive($isActive)->setHref($uri);
            $menu->addMenuItem($menuItem);
        }

        $this->view->getModuleTemplate()->getDocHeaderComponent()->getMenuRegistry()->addMenu($menu);
    }
}
