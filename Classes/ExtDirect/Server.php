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
 * $Id: Server.php 63469 2012-06-15 07:54:52Z francois $
 */
class Tx_Examples_ExtDirect_Server {

	/**
	 * Returns the count of records for a table
	 *
	 * This method is a simple demonstration of ExtDirect call
	 *
	 * @param string $table Name of a TYPO3 table
	 * @return array
	 */
	public function countRecords($table) {
			// Return the count of all non-deleted records for the given table
		return array(
			'data' => $GLOBALS['TYPO3_DB']->exec_SELECTcountRows('uid', $table, '1 = 1' . \TYPO3\CMS\Backend\Utility\BackendUtility::deleteClause($table))
		);
	}
}
?>