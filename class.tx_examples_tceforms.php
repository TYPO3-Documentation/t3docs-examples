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
 * Class that implements many examples related to TCA or TCEform manipulations
 *
 * @author		Francois Suter <francois@typo3.org>
 * @package		TYPO3
 * @subpackage	tx_examples
 *
 * $Id$
 */
class tx_examples_tceforms {
	function specialField($PA, $fObj) {
		$formField  = '<div style="padding: 5px; background-color: yellow;">';
		$formField .= '<input type="text" name="' . $PA['itemFormElName'] . '"';
		$formField .= ' value="' . htmlspecialchars($PA['itemFormElValue']) . '"';
		$formField .= ' onchange="' . htmlspecialchars(implode('', $PA['fieldChangeFunc'])) . '"';
		$formField .= $PA['onFocus'];
		$formField .= ' /></div>';
		return $formField;
	}
}
?>
