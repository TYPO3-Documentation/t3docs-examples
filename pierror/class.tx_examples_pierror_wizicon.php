<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Francois Suter <typo3@cobweb.ch>
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
 * Class that adds the wizard icon.
 *
 * @author		Francois Suter <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_examples
 *
 * $Id$
 */
class tx_examples_pierror_wizicon {

	/**
	 * Processing the wizard items array
	 *
	 * @param array $wizardItems The wizard items
	 * @return array Modified array with wizard items
	 */
	function proc($wizardItems)	{
		$wizardItems['plugins_tx_examples_pierror'] = array(
			'icon' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('examples') . 'Resources/Public/Images/PiErrorWizard.png',
			'title' => $GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/locallang.xlf:pierror_wizard_title'),
			'description' => $GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/locallang.xlf:pierror_wizard_description'),
			'params' => '&defVals[tt_content][CType]=list&[list_type]=examples_pierror'
		);

		return $wizardItems;
	}
}
?>