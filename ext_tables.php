<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
$tempColumns = array (
	'tx_examples_options' => array (
		'exclude' => 0,		
		'label' => 'LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_options',
		'config' => array (
			'type' => 'select',
			'items' => array (
				array('LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_options.I.0', '1'),
				array('LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_options.I.1', '2'),
				array('LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_options.I.2', '--div--'),
				array('LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_options.I.3', '3'),
			),
			'size' => 1,	
			'maxitems' => 1,
		)
	),
	'tx_examples_special' => array (
		'exclude' => 0,		
		'label' => 'LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_special',
		'config' => array (
			'type' => 'user',
			'size' => '30',
			'userFunc' => 'EXT:examples/class.tx_examples_tceforms.php:tx_examples_tceforms->specialField'
		)
	),
);

t3lib_div::loadTCA('fe_users');
t3lib_extMgm::addTCAcolumns('fe_users',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('fe_users','tx_examples_options;;;;1-1-1, tx_examples_special');

	// Load the full TCA
t3lib_div::loadTCA('tt_content');

	// Disable the display of layout and select_key fields
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout,select_key,pages';

	// Activate the display of the plug-in flexform field and set FlexForm definition
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:examples/flexform_ds.xml');

t3lib_extMgm::addPlugin(array('LLL:EXT:examples/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY . '_pi1'), 'list_type');
?>