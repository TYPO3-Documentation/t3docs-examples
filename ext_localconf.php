<?php
/* $Id$ */

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

	// Load XCLASSing of db_new
	// USAGE: Core APIs > TYPO3 API overview > PHP Class Extension > Which classes? > Example - Adding a small feature in the interface
$TYPO3_CONF_VARS['BE']['XCLASS']['typo3/db_new.php'] = t3lib_extMgm::extPath($_EXTKEY, 'xclasses/class.tx_examples_scdbnew.php');

	// Load XCLASSing of TCEforms
	// USAGE: Core APIs > TYPO3 API overview > PHP Class Extension > A few examples of extending the backend classes
$TYPO3_CONF_VARS['BE']['XCLASS']['t3lib/class.t3lib_tceforms.php'] = t3lib_extMgm::extPath($_EXTKEY, 'xclasses/class.tx_examples_tceforms.php');

	// Add tt_news listing to Web > Page module
	// USAGE: Core APIs > TYPO3 API overview > Various examples > Support for custom tables in the Page module
$TYPO3_CONF_VARS['EXTCONF']['cms']['db_layout']['addTables']['tt_news'][0] = array(
	'fList' => 'title,short;author',
	'icon' => TRUE
);

	// Define custom permission options
	// USAGE: Core APIs > TYPO3 API overview > Various examples > Using custom permission options
$TYPO3_CONF_VARS['BE']['customPermOptions'] = array(
	'tx_coreunittest_cat1' => array(
		'header' => '[Core Unittest] Category 1',
		'items' => array(
			'key1' => array('Key 1 header'),
			'key2' => array('Key 2 header'),
			'key3' => array('Key 3 header'),
			)
		)
	);
?>
