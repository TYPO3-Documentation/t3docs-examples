<?php
namespace Documentation\Examples\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012-2013 Documentation Team <documentation@typo3.org>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

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
		$this->flashMessageContainer->add(
			'This is a notice message',
			'Notification',
			\TYPO3\CMS\Core\Messaging\FlashMessage::NOTICE
		);
		$this->flashMessageContainer->add(
			'This is an information message',
			'Information',
			\TYPO3\CMS\Core\Messaging\FlashMessage::INFO
		);
		$this->flashMessageContainer->add(
			'This is a success message',
			'Hooray!',
			\TYPO3\CMS\Core\Messaging\FlashMessage::OK
		);
		$this->flashMessageContainer->add(
			'This is a warning message',
			'Watch out',
			\TYPO3\CMS\Core\Messaging\FlashMessage::WARNING
		);
		$this->flashMessageContainer->add(
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
		$this->flashMessageContainer->add(
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
?>