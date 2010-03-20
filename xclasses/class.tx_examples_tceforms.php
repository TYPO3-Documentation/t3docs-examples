<?php
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
 * This class XCLASSes t3lib_TCEforms to change the appearance of some fields
 *
 * @author		Francois Suter <francois@typo3.org>
 * @package		TYPO3
 * @subpackage	tx_examples
 *
 * $Id$
 */
class ux_t3lib_TCEforms extends t3lib_TCEforms {
	/**
	 * This method increases the size of the fields by 1.5
	 *
	 * USAGE: Core APIs > TYPO3 API overview > PHP Class Extension > A few examples of extending the backend classes
	 *
	 * @param	integer		$size: default filed size
	 * @param	boolean		$textarea: TRUE if field is a textarea
	 * @return	string		Either a "style" attribute string or "cols"/"size" attribute string
	 */
	function formWidth($size = 48, $textarea = FALSE) {
		$size = round($size * 1.5);
		return parent::formWidth($size, $textarea);
	}

	/**
	 * This method modifies the rendering of the palettes
	 *
	 * USAGE: Core APIs > TYPO3 API overview > PHP Class Extension > A few examples of extending the backend classes
	 *
	 * @param	array		The palette array to print
	 * @return	string		HTML output
	 */
	function printPalette($palArr) {
			// Change all field labels in the palette to uppercase
		foreach ($palArr as $key => $palette) {
			$palArr[$key]['NAME'] = strtoupper($palArr[$key]['NAME']);
		}
		return parent::printPalette($palArr);
	}
}
?>
