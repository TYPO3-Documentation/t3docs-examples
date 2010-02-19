<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_examples_dummy'] = array(
	'ctrl' => $TCA['tx_examples_dummy']['ctrl'],
	'columns' => array(
		'hidden' => array(		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type'    => 'check',
				'default' => '0'
			)
		),
		'record_type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_dummy.record_type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:examples/locallang_db.xml:tx_examples_dummy.record_type.0', 0),
					array('LLL:EXT:examples/locallang_db.xml:tx_examples_dummy.record_type.1', 1),
					array('LLL:EXT:examples/locallang_db.xml:tx_examples_dummy.record_type.2', 2),
				)
			)
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_dummy.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			)
		),
		'some_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_dummy.some_date',
			'config' => array(
				'type' => 'input',
				'size' => '12',
				'eval' => 'date',
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'hidden, record_type, title, some_date '),
			// Exchange this row with the one above for the example at the end of the types reference table
//		'0' => array('showitem' => 'hidden;;;;1-1-1, record_type;;;;2-2-2, title;;;;3-3-3, some_date '),
		'1' => array('showitem' => 'record_type, title '),
		'2' => array('showitem' => 'title, some_date, hidden, record_type '),
	),
);
?>