<?php
namespace Documentation\Examples\Service;

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Francois Suter <francois@typo3.org>
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
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * This class XCLASSes NewRecordController to modify the layout of the New Record Wizard
 *
 * @author		Francois Suter <francois@typo3.org>
 * @package		TYPO3
 * @subpackage	tx_examples
 *
 * $Id$
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
		if ($table == 'pages') {
			// URL for the menu item. Point to the page tree example module, passing the page id.
			$baseUrl = 'mod.php?M=tools_ExamplesExamples&tx_examples_tools_examplesexamples%5Baction%5D=tree&tx_examples_tools_examplesexamples%5Bcontroller%5D=Default';
			$baseUrl .= '&tx_examples_tools_examplesexamples%5Bpage%5D=' . $uid;

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
?>
