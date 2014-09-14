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

/**
 * Controller for the backend module
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_examples
 */
class DefaultController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * Renders the list of all possible flash messages
	 *
	 * @return void
	 */
	public function flashAction() {
			// Issue one of each type of flash messages
		$this->addFlashMessage(
			'This is a notice message',
			'Notification',
			\TYPO3\CMS\Core\Messaging\FlashMessage::NOTICE
		);
		$this->addFlashMessage(
			'This is an information message',
			'Information',
			\TYPO3\CMS\Core\Messaging\FlashMessage::INFO
		);
		$this->addFlashMessage(
			'This is a success message',
			'Hooray!',
			\TYPO3\CMS\Core\Messaging\FlashMessage::OK
		);
		$this->addFlashMessage(
			'This is a warning message',
			'Watch out',
			\TYPO3\CMS\Core\Messaging\FlashMessage::WARNING
		);
		$this->addFlashMessage(
			'
				<p>This is an error message</p>
				<ul>
					<li>It\'s inside a div</li>
					<li>so it can contain</li>
					<li>pretty much <strong>any markup</strong></li>
				</ul>
			',
			'Whoops!',
			\TYPO3\CMS\Core\Messaging\FlashMessage::ERROR
		);
		$this->addFlashMessage(
			'This message is forced to be NOT stored in the session by setting the forth argument to FALSE.',
			'Success',
			\TYPO3\CMS\Core\Messaging\FlashMessage::OK,
			FALSE
		);
		$this->addFlashMessage('This is a simple message, by default without title and with severity OK.');
	}

	/**
	 * Creates some entries using the 6.0+ logging API
	 *
	 * @return void
	 */
	public function logAction() {
		/** @var $logger \TYPO3\CMS\Core\Log\Logger */
		$logger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);
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
			\TYPO3\CMS\Core\Log\LogLevel::CRITICAL,
			'This is an utter failure!'
		);
		$this->addFlashMessage(
			'3 log entries created',
			'',
			\TYPO3\CMS\Core\Messaging\FlashMessage::INFO
		);
	}

	/**
	 * Displays a page tree
	 *
	 * @return void
	 */
	public function treeAction() {
		// Get page record for tree starting point. May be passed as an argument.
		try {
			$startingPoint = $this->request->getArgument('page');
		}
		catch (\Exception $e) {
			$startingPoint = 1;
		}
		$pageRecord = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord(
			'pages',
			$startingPoint
		);

		// Create and initialize the tree object
		/** @var $tree \TYPO3\CMS\Backend\Tree\View\PageTreeView */
		$tree = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Tree\\View\\PageTreeView');
		$tree->init('AND ' . $GLOBALS['BE_USER']->getPagePermsClause(1));

		// Creating the icon for the current page and add it to the tree
		$html = \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIconForRecord(
			'pages',
			$pageRecord,
			array(
				'title' => $pageRecord['title']
			)
		);
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
		\TYPO3\CMS\Core\Utility\GeneralUtility::devLog('page tree', 'examples', 0, $tree->tree);

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
	public function clipboardAction() {
		/** @var $clipboard \TYPO3\CMS\Backend\Clipboard\Clipboard */
		$clipboard = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Clipboard\\Clipboard');
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
	public function linksAction() {

	}
}
