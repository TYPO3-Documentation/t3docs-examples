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
class tx_examples_tca {
	/**
	 * This method renders a user-defined field
	 *
	 * @param	array	$PA: parameters of the field
	 * @param	object	$fObj: calling object (TCEform)
	 * @return	string	HTML for the field
	 */
	function specialField($PA, $fObj) {
		$formField  = '<div style="padding: 5px; background-color: yellow;">';
		$formField .= '<input type="text" name="' . $PA['itemFormElName'] . '"';
		$formField .= ' value="' . htmlspecialchars($PA['itemFormElValue']) . '"';
		$formField .= ' onchange="' . htmlspecialchars(implode('', $PA['fieldChangeFunc'])) . '"';
		$formField .= $PA['onFocus'];
		$formField .= ' /></div>';
		return $formField;
	}

	/**
	 * This method renders a wizard providing JavaScript +/- controls
	 * to increase or decrease an integer value in a field
	 *
	 * @param	array	$PA: parameters of the field
	 * @param	object	$fObj: calling object (TCEform)
	 * @return	string	HTML for the wizard
	 */
	function someWizard($PA, $fObj) {
			// Note that the information is passed by reference,
			// so it's possible to manipulate the field directly
			// Here we highlight the field with the color passed as parameter
		$backgroundColor = 'white';
		if (!empty($PA['params']['color'])) {
			$backgroundColor = $PA['params']['color'];
		}
		$PA['item'] = '<div style="background-color: ' . $backgroundColor . '; padding: 4px;">' . $PA['item'] . '</div>';

			// Assemble the wizard itself
		$output = '<div style="margin-top: 8px; margin-left: 4px;">';
			// Create the + button
		$onClick = "document." . $PA['formName'] . "['" . $PA['itemName'] . "'].value++; return false;";
		$output .= '<a href="#" onclick="' . htmlspecialchars($onClick) . '" style="padding: 6px; border: 1px solid black; background-color: #999">+</a>';
			// Create the - button
		$onClick = "document." . $PA['formName'] . "['" . $PA['itemName'] . "'].value--; return false;";
		$output .= '<a href="#" onclick="' . htmlspecialchars($onClick) . '" style="padding: 6px; border: 1px solid black; background-color: #999">-</a>';
		$output .= '</div>';
		return $output;
	}
}
?>
