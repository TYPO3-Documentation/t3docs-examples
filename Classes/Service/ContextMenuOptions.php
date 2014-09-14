<?php
namespace Documentation\Examples\Service;

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
 * This class XCLASSes NewRecordController to modify the layout of the New Record Wizard
 *
 * @author Francois Suter <francois@typo3.org>
 * @package TYPO3
 * @subpackage tx_examples
 */
class ContextMenuOptions {

	/**
	 * Adds a sample item to the CSM
	 *
	 * @param \TYPO3\CMS\Backend\ClickMenu\ClickMenu $parentObject Back-reference to the calling object
	 * @param array $menuItems Current list of menu items
	 * @param string $table Name of the table the clicked on item belongs to
	 * @param integer $uid Id of the clicked on item
	 *
	 * @return array Modified list of menu items
	 */
	public function main(\TYPO3\CMS\Backend\ClickMenu\ClickMenu $parentObject, $menuItems, $table, $uid) {
		// Activate the menu item only for "pages" table
		if ($table === 'pages') {
			// URL for the menu item. Point to the page tree example module, passing the page id.
			$baseUrl = \TYPO3\CMS\Backend\Utility\BackendUtility::getModuleUrl(
				'tools_ExamplesExamples',
				array(
					'tx_examples_tools_examplesexamples[action]' => 'tree',
					'tx_examples_tools_examplesexamples[controller]' => 'Default',
					'tx_examples_tools_examplesexamples[page]' => $uid
				)
			);

			// Add new menu item with the following parameters:
			// 1) Label
			// 2) Icon
			// 3) URL
			// 4) = 1 disable item in docheader
			$menuItems[] = $parentObject->linkItem(
				$GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/locallang.xml:csm_view_page'),
				\TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon('extensions-examples-page-tree'),
				$parentObject->urlRefForCM($baseUrl),
				1
			);
		}
		return $menuItems;
	}
}
