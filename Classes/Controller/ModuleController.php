<?php
namespace Documentation\Examples\Controller;

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
use TYPO3\CMS\Backend\Clipboard\Clipboard;
use TYPO3\CMS\Backend\Template\Components\Menu\Menu;
use TYPO3\CMS\Backend\Template\Components\Menu\MenuItem;
use TYPO3\CMS\Backend\Tree\View\PageTreeView;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Log\LogLevel;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Messaging\FlashMessage;
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
class ModuleController extends ActionController
{

    /**
     * @var BackendTemplateView
     */
    protected $view;

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
        $items = array('flash', 'log', 'tree', 'clipboard', 'links');

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
                    array(),
                    'Module'
            );
            $menuItem->setActive($isActive)->setHref($uri);
            $menu->addMenuItem($menuItem);
        }

        $this->view->getModuleTemplate()->getDocHeaderComponent()->getMenuRegistry()->addMenu($menu);
    }

    /**
     * Renders the list of all possible flash messages
     *
     * @return void
     */
    public function flashAction()
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
    }

    /**
     * Creates some entries using the 6.0+ logging API
     *
     * @return void
     */
    public function logAction()
    {
        /** @var $logger \TYPO3\CMS\Core\Log\Logger */
        $logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(__CLASS__);
        $logger->info('Everything went fine.');
        $logger->warning('Something went awry, check your configuration!');
        $logger->error(
                'This was not a good idea',
                array(
                        'foo' => 'bar',
                        'bar' => $this,
                )
        );
        $logger->log(
                LogLevel::CRITICAL,
                'This is an utter failure!'
        );
        $this->addFlashMessage(
                '3 log entries created',
                '',
                FlashMessage::INFO
        );
    }

    /**
     * Displays a page tree
     *
     * @return void
     */
    public function treeAction()
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
        $html = $iconFactory->getIconForRecord(
                'pages',
                $pageRecord,
                Icon::SIZE_SMALL
        )->render();
        $tree->tree[] = array(
                'row' => $pageRecord,
                'HTML' => $html
        );

        // Create the page tree, from the starting point, 2 levels deep
        $depth = 2;
        $tree->getTree(
                $startingPoint,
                $depth,
                ''
        );
        GeneralUtility::devLog('page tree', 'examples', 0, $tree->tree);

        // Pass the tree to the view
        $this->view->assign(
                'tree',
                $tree->tree
        );
    }

    /**
     * Displays the content of the clipboard
     *
     * @return void
     */
    public function clipboardAction()
    {
        /** @var $clipboard Clipboard */
        $clipboard = GeneralUtility::makeInstance(Clipboard::class);
        // Read the clipboard content from the user session
        $clipboard->initializeClipboard();
        // Uncomment to produce debug output
        //		\TYPO3\CMS\Core\Utility\DebugUtility::debug($clipboard->clipData);

        // Access files and pages content of current pad
        $currentPad = array(
                'files' => $clipboard->elFromTable('_FILE'),
                'pages' => $clipboard->elFromTable('pages'),
        );

        // Switch to normal pad and retrieve files and pages content
        $clipboard->setCurrentPad('normal');
        $normalPad = array(
                'files' => $clipboard->elFromTable('_FILE'),
                'pages' => $clipboard->elFromTable('pages'),
        );

        // Pass data to the view for display
        $this->view->assignMultiple(
                array(
                        'current' => $currentPad,
                        'normal' => $normalPad
                )
        );
    }

    /**
     * Displays links to edit records
     *
     * @return void
     */
    public function linksAction()
    {

    }

    /**
     * Returns a count of log entries, based on various grouping criteria, in JSON format.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function countAction(ServerRequestInterface $request, ResponseInterface $response)
    {
        $requestParameters = $request->getQueryParams();
        $count = $this->getDatabaseConnection()->exec_SELECTcountRows(
                'uid',
                addslashes($requestParameters['table'])
        );

        // Send the response
        $response->getBody()->write(json_encode($count));
        return $response;
    }

    /**
     * Returns the global database connection object.
     *
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}
