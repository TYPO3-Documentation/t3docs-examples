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
 * This class answers to ExtDirect calls from the 'examples' BE module
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_examples
 */
class Tx_Examples_Utilities_Viewport {

	/**
	 * Modifies the configuration of the TYPO3 Viewport
	 *
	 * This method uses a page rendering hook to change the left-hand menu's configuration
	 * and make it collapsible
	 *
	 * @param array $parameters List of parameters
	 * @param t3lib_pageRenderer $pageRenderer Back-reference to the page rendering object
	 * @return array
	 */
	public function renderPreProcess($parameters, $pageRenderer) {
		$pageRenderer->addExtOnReadyCode('
			Ext.apply(TYPO3.Viewport.configuration.items[1], {
				split: true,
				collapsible: true,
				collapseMode: "mini",
				hideCollapseTool: true,
				animCollapse: false
			});',
			true
		);
	}
}
