<?php
namespace Documentation\Examples\ViewHelpers\Be;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Documentation Team <documentation@typo3.org>
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
 * This class is used to load application-specific files (JS and CSS) for the BE module
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_examples
 */
class HeaderViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Be\AbstractBackendViewHelper {

	/**
	 * Renders the view helper
	 *
	 * In this case, it actually renders nothing, but only loads stuff in the page header
	 *
	 * @return void
	 */
	public function render() {
		$pageRenderer = $this->getDocInstance()->getPageRenderer();

		// Add base ExtDirect code
		$pageRenderer->addExtDirectCode(
			array('TYPO3.Examples')
		);
		// Make localized labels available in JavaScript context
		$pageRenderer->addInlineLanguageLabelFile('EXT:examples/Resources/Private/Language/locallang.xml');

		// Load application specific JS
		$pageRenderer->addJsFile(
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('examples') . 'Resources/Public/JavaScript/Application.js',
			'text/javascript',
			FALSE
		);
	}
}

?>