<?php
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
 * Class that adds the wizard icon.
 *
 * @author Francois Suter <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_examples
 */
class tx_examples_pierror_wizicon {

	/**
	 * Processing the wizard items array
	 *
	 * @param array $wizardItems The wizard items
	 * @return array Modified array with wizard items
	 */
	public function proc($wizardItems)	{
		$wizardItems['plugins_tx_examples_pierror'] = array(
			'icon' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('examples') . 'Resources/Public/Images/PiErrorWizard.png',
			'title' => $GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/locallang.xlf:pierror_wizard_title'),
			'description' => $GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/locallang.xlf:pierror_wizard_description'),
			'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=examples_pierror'
		);

		return $wizardItems;
	}
}
