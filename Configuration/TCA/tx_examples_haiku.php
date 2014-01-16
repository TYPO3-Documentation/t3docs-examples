<?php
return array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku',
		'label'     => 'title',
		'label_userFunc' => 'Documentation\\Examples\\Userfuncs\\Tca->haikuTitle',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
		),
		'searchFields' => 'title,poem',
		'dividers2tabs' => TRUE,
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('examples') . 'Resources/Public/Images/Haiku.png',
	),
	'interface' => array(
		'showRecordFieldList' => 'title,season,angle',
		'maxDBListItems' => 5,
		'maxSingleDBListItems' => 20
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
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'required,trim',
			)
		),
		'poem' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.poem',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 6,
				'softref' => 'typolink_tag,images,email[subst],url',
			),
			'defaultExtras' => 'richtext[]:rte_transform[mode=tx_examples_transformation-ts_css]:static_write[filename|poem]'
				// NOTE: parameters 4 and 5 don't seem to apply, this must be broken. Investigate later.
//			'defaultExtras' => 'richtext[]:static_write[filename|poem||filesource|filestatus]'
		),
		'filename' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.filename',
			'config' => array(
				'type' => 'input',
				'size' => 30,
			)
		),
		'filesource' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.filesource',
			'config' => array(
				'type' => 'check',
			)
		),
		'filestatus' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.filestatus',
			'config' => array(
				'type' => 'input',
				'size' => 30,
			)
		),
		'season' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim',
				'wizards' => array(
					'season_picker' => array(
						'type' => 'select',
						'mode' => '',
						'items' => array(
							array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season.spring', 'Spring'),
							array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season.summer', 'Summer'),
							array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season.autumn', 'Autumn'),
							array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season.winter', 'Winter'),
						)
					)
				)
			)
		),
		'weirdness' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.weirdness',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'int',
				'wizards' => array(
					'specialWizard' => array(
						'type' => 'userFunc',
						'userFunc' => 'Documentation\\Examples\\Userfuncs\\Tca->someWizard',
						'params' => array(
							'color' => 'green'
						)
					)
				)
			)
		),
		'color' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.color',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim',
				'wizards' => array(
					'colorChoice' => array(
						'type' => 'colorbox',
						'title' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.colorPick',
						'script' => 'wizard_colorpicker.php',
						'dim' => '20x20',
						'tableStyle' => 'border: solid 1px black; margin-left: 20px;',
						'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
						'exampleImg' => 'EXT:examples/res/images/japanese_garden.jpg',
					)
				)
			)
		),
		'angle' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.angle',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'trim,int',
				'range' => array(
					'lower' => -90,
					'upper' => 90
				),
				'default' => 0,
				'wizards' => array(
					'angle' => array(
						'type' => 'slider',
						'step' => 10,
						'width' => 200
					)
				)
			)
		),
			// USAGE: TCA reference > $TCA array reference > ['columns'][fieldname]['config'] / TYPE: "group"
			// Demonstrates the various values the property disable_controls can take
		'image1' => array(
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.image1',
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
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.image2',
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
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.image3',
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
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.image4',
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
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.image5',
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
				'disable_controls' => 'delete'
			),
		),
		'image6' => array(
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.image6',
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
				'disable_controls' => 'browser,upload,list,delete'
			),
		),
		// USAGE: TCA reference > $TCA array reference > ['columns'][fieldname]['config'] / TYPE: "select" > Examples
		// Use the following TSconfig to show the effect:
		// TCEFORM.tx_examples_haiku.reference_page.PAGE_TSCONFIG_STR = image
		'reference_page' => array(
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.reference_page',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'pages',
				'foreign_table_where' => "AND pages.title LIKE '%###PAGE_TSCONFIG_STR###%'",
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1
			),
		),
		'related_records' => array(
			'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.related_records',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'pages, tt_content',
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 10,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'searchWholePhrase' => 1
						),
						'pages' => array(
							'searchCondition' => 'doktype = 1'
						)
					)
				)
			)
		)
	),
	'types' => array(
		'0' => array('showitem' => 'hidden;;;;1-1-1, title;;;;2-2-2, poem, filename;;;;3-3-3, season;;;;4-4-4, weirdness, color, angle, --div--;LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.images, image1, image2, image3, image4, image5, image6, --div--;LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.relations, reference_page, related_records'),
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
