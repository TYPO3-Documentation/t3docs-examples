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
