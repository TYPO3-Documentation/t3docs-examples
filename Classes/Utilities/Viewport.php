<?php
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
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * This class answers to ExtDirect calls from the 'examples' BE module
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_examples
 *
 * $Id$
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
?>