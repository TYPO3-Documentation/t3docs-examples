<?php
return array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'type'		=> 'record_type',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
		),
		'typeicon_classes' => array(
			'default' => 'extensions-examples-dummy-default'
		)
	),
	'columns' => array(
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config'  => array(
				'type'    => 'check',
				'default' => '0'
			)
		),
		'record_type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.record_type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.record_type.0', 0),
					array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.record_type.1', 1),
					array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.record_type.2', 2),
				)
			)
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'required,trim',
			)
		),
		'some_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.some_date',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'eval' => 'date',
			)
		),
		'enforce_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.enforce_date',
			'config' => array(
				'type' => 'check',
			)
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.description',
			'config' => array(
				'type' => 'text',
				'cols' => 50,
				'rows' => 3
			)
		)
	),
	'types' => array(
			// NOTE: there are alternate versions of this row to demonstrate various features
//		'0' => array('showitem' => 'hidden, record_type, title, some_date '),
			// Use this row to demonstrate usage of palettes
		'0' => array('showitem' => 'hidden, record_type, title, some_date;;1 '),
			// Use this row when discussing special configuration nowrap
			// (paste this into the description field: This is a very long text that will not wrap when I get to the end of the box, which is very far away, away, away, away, away, away)
//		'0' => array('showitem' => 'hidden, record_type, title, description;;;nowrap, some_date;;1 '),
			// Additional types
		'1' => array('showitem' => 'record_type, title '),
		'2' => array('showitem' => 'title, some_date, hidden, record_type '),
	),
	'palettes' => array(
		'1' => array('showitem' => 'enforce_date'),
	),
);
