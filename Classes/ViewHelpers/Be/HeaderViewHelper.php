<?php
namespace Documentation\Examples\ViewHelpers\Be;

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

