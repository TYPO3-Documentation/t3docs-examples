<?php
namespace Documentation\Examples\Xclass;

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
class NewRecordController extends \TYPO3\CMS\Backend\Controller\NewRecordController {
	/**
	 * Adds a section at the bottom of the New Record Wizard
	 *
	 * USAGE: Core APIs > TYPO3 API overview > PHP Class Extension > Which classes? > Example - Adding a small feature in the interface
	 *
	 * @return	void
	 */
	public function regularNew() {
		parent::regularNew();
		$this->code .= $this->moduleTemplate->section(
			$GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/locallang.xlf:help'),
			$GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/locallang.xlf:make_choice'),
			0,
			1
		);
	}
}
