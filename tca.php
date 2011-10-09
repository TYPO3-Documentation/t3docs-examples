<?php
/* $Id$*/
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
				'size' => 30,
				'eval' => 'required,trim',
			)
		),
		'some_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_dummy.some_date',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'eval' => 'date',
			)
		),
		'enforce_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_dummy.enforce_date',
			'config' => array(
				'type' => 'check',
			)
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_dummy.description',
			'config' => array(
				'type' => 'text',
				'cols' => 50,
				'rows' => 3
			)
		)
	),
	'types' => array(
			// NOTE: there are alternate versions of this row to demonstrate various features
		'0' => array('showitem' => 'hidden, record_type, title, some_date '),
			// Exchange this row with the one above for the example at the end of the types reference table
//		'0' => array('showitem' => 'hidden;;;;1-1-1, record_type;;;;2-2-2, title;;;;3-3-3, some_date '),
			// Use this row to demonstrate usage of palettes
//		'0' => array('showitem' => 'hidden;;;;1-1-1, record_type;;;;2-2-2, title;;;;3-3-3, some_date;;1 '),
			// Use this row when discussion special configuration
//		'0' => array('showitem' => 'hidden;;;;1-1-1, record_type;;;;2-2-2, title;;;;3-3-3, description;;;nowrap, some_date;;1 '),
		'1' => array('showitem' => 'record_type, title '),
		'2' => array('showitem' => 'title, some_date, hidden, record_type '),
	),
	'palettes' => array(
		'1' => array('showitem' => 'enforce_date'),
	),
);

$TCA['tx_examples_haiku'] = array(
	'ctrl' => $TCA['tx_examples_haiku']['ctrl'],
	'columns' => array(
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type'    => 'check',
				'default' => '0'
			)
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'required,trim',
			)
		),
		'poem' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.poem',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 6
			),
			'defaultExtras' => 'richtext[]:static_write[filename|poem]'
				// NOTE: parameters 4 and 5 don't seem to apply, this must be broken. Investigate later.
//			'defaultExtras' => 'richtext[]:static_write[filename|poem||filesource|filestatus]'
		),
		'filename' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.filename',
			'config' => array(
				'type' => 'input',
				'size' => 30,
			)
		),
		'filesource' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.filesource',
			'config' => array(
				'type' => 'check',
			)
		),
		'filestatus' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.filestatus',
			'config' => array(
				'type' => 'input',
				'size' => 30,
			)
		),
		'season' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.season',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim',
				'wizards' => array(
					'season_picker' => array(
						'type' => 'select',
						'mode' => '',
						'items' => array(
							array('LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.season.spring', 'Spring'),
							array('LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.season.summer', 'Summer'),
							array('LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.season.autumn', 'Autumn'),
							array('LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.season.winter', 'Winter'),
						)
					)
				)
			)
		),
		'weirdness' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.weirdness',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'int',
				'wizards' => array(
					'specialWizard' => array(
						'type' => 'userFunc',
						'userFunc' => 'EXT:examples/class.tx_examples_tca.php:tx_examples_tca->someWizard',
						'params' => array(
							'color' => 'green'
						)
					)
				)
			)
		),
		'color' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.color',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim',
				'wizards' => array(
					'colorChoice' => array(
						'type' => 'colorbox',
						'title' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.colorPick',
						'script' => 'wizard_colorpicker.php',
						'dim' => '20x20',
						'tableStyle' => 'border: solid 1px black; margin-left: 20px;',
						'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
						'exampleImg' => 'EXT:examples/res/images/japanese_garden.jpg',
					)
				)
			)
		),
		'image1' => array(
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.image1',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/pics',
				'show_thumbs' => '1',
				'size' => '3',
				'maxitems' => '200',
				'minitems' => '0',
				'autoSizeMax' => 40,
			),
		),
		'image2' => array(
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.image2',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/pics',
				'show_thumbs' => '1',
				'size' => '3',
				'maxitems' => '200',
				'minitems' => '0',
				'autoSizeMax' => 40,
				'disable_controls' => 'browser'
			),
		),
		'image3' => array(
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.image3',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/pics',
				'show_thumbs' => '1',
				'size' => '3',
				'maxitems' => '200',
				'minitems' => '0',
				'autoSizeMax' => 40,
				'disable_controls' => 'upload'
			),
		),
		'image4' => array(
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.image4',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/pics',
				'show_thumbs' => '1',
				'size' => '3',
				'maxitems' => '200',
				'minitems' => '0',
				'autoSizeMax' => 40,
				'disable_controls' => 'list'
			),
		),
		'image5' => array(
			'label' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.image5',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/pics',
				'show_thumbs' => '1',
				'size' => '3',
				'maxitems' => '200',
				'minitems' => '0',
				'autoSizeMax' => 40,
				'disable_controls' => 'browser,upload,list'
			),
		),
	),
	'types' => array(
		'0' => array('showitem' => 'hidden;;;;1-1-1, title;;;;2-2-2, poem, filename;;;;3-3-3, season;;;;4-4-4, weirdness, color, --div--;LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.images, image1, image2, image3, image4, image5'),
			// NOTE: since filestatus is not used yet, let's not show it, nor the palette with filesource,
			// but it should be made to work at some point (bug in the Core?)
//		'0' => array('showitem' => 'hidden;;;;1-1-1, title;;;;2-2-2, poem, filename;;1;;3-3-3, filestatus, season;;;;4-4-4, weirdness, color'),
	),
/*
 * NOTE: use the filesource flag only when the problems of static_write have been solved
	'palettes' => array(
		'1' => array('showitem' => 'filesource'),
	),
 */
);
?>