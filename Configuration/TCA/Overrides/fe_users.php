<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}


// Add some fields to FE Users table to show TCA fields definitions
// USAGE: TCA Reference > $TCA array reference > ['columns'][fieldname]['config'] / TYPE: "select"
$temporaryColumns = array (
	'tx_examples_options' => array (
		'exclude' => 0,
		'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options',
		'config' => array (
			'type' => 'select',
			'items' => array (
				array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.0', '1'),
				array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.1', '2'),
				array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.2', '--div--'),
				array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.3', '3'),
			),
			'size' => 1,
			'maxitems' => 1,
		)
	),
	'tx_examples_special' => array (
		'exclude' => 0,
		'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_special',
		'config' => array (
			'type' => 'user',
			'size' => '30',
			'userFunc' => 'Documentation\\Examples\\Userfuncs\\Tca->specialField',
			'parameters' => array(
				'color' => 'blue'
			)
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
	'fe_users',
	$temporaryColumns,
	1
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'fe_users',
	'tx_examples_options;;;;1-1-1, tx_examples_special'
);
