<?php
/* $Id: $ */

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

	// Load XCLASSing of db_new
$TYPO3_CONF_VARS['BE']['XCLASS']['typo3/db_new.php'] = t3lib_extMgm::extPath($_EXTKEY, 'xclasses/class.tx_examples_scdbnew.php');

	// Load XCLASSing of TCEforms
$TYPO3_CONF_VARS['BE']['XCLASS']['t3lib/class.t3lib_tceforms.php'] = t3lib_extMgm::extPath($_EXTKEY, 'xclasses/class.tx_examples_tceforms.php');
?>
