<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku',
        'label' => 'title',
        'label_userFunc' => \T3docs\Examples\Userfuncs\Tca::class . '->haikuTitle',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY title',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,poem',
        'dividers2tabs' => true,
        'typeicon_classes' => [
            'default' => 'tx_examples-haiku',
        ],
    ],
    'interface' => [
        'showRecordFieldList' => 'title,season,angle',
        'maxDBListItems' => 5,
        'maxSingleDBListItems' => 20,
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ]
        ],
        'title' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'required,trim',
            ],
        ],
        'poem' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.poem',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 6,
                'softref' => 'typolink_tag,images,email[subst],url',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
            ],

        ],
        'filename' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.filename',
            'config' => [
                'type' => 'input',
                'size' => 30,
            ],
        ],
        'filesource' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.filesource',
            'config' => [
                'type' => 'check',
            ],
        ],
        'filestatus' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.filestatus',
            'config' => [
                'type' => 'input',
                'size' => 30,
            ],
        ],
        'season' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim',
                'valuePicker' => [
                    'items' => [
                        0 =>
                            [
                                0 => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season.spring',
                                1 => 'Spring',
                            ],
                        1 =>
                            [
                                0 => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season.summer',
                                1 => 'Summer',
                            ],
                        2 =>
                            [
                                0 => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season.autumn',
                                1 => 'Autumn',
                            ],
                        3 =>
                            [
                                0 => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season.winter',
                                1 => 'Winter',
                            ],
                    ],
                    'mode' => '',
                ],
            ],
        ],
        'weirdness' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.weirdness',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'int',
                'wizards' => [
                    'specialWizard' => [
                        'type' => 'userFunc',
                        'userFunc' => \T3docs\Examples\Controller\PlusMinusWizardController::class . '->render',
                        'params' => [
                            'color' => 'green',
                        ],
                    ],
                ],
            ],
        ],
        'color' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.color',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim',
                'renderType' => 'colorpicker',
            ],
        ],
        'angle' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.angle',
            'config' => [
                'type' => 'input',
                'size' => 5,
                'eval' => 'trim,int',
                'range' => [
                    'lower' => -90,
                    'upper' => 90,
                ],
                'default' => 0,
                'slider' => [
                    'width' => 200,
                    'step' => 10,
                ],
            ],
        ],
        // USAGE: TCA reference > $TCA array reference > ['columns'][fieldname]['config'] / TYPE: "select" > Examples
        // Use the following TSconfig to show the effect:
        // TCEFORM.tx_examples_haiku.reference_page.PAGE_TSCONFIG_STR = image
        'reference_page' => [
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.reference_page',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'pages',
                'foreign_table_where' => "AND pages.title LIKE '%###PAGE_TSCONFIG_STR###%'",
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
                'renderType' => 'selectSingle',
            ],
        ],
        'related_records' => [
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.related_records',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages, tt_content',
                'size' => 5,
                'minitems' => 0,
                'maxitems' => 10,
                'suggestOptions' => [
                    'default' => [
                        'searchWholePhrase' => 1,
                    ],
                    'pages' => [
                        'searchCondition' => 'doktype = 1',
                    ],
                ],
            ],
        ],
        'related_content' => [
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.related_content',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tt_content',
                'foreign_table_where' => 'ORDER BY header ASC',
                'size' => 5,
                'minitems' => 0,
                'maxitems' => 999,
                'enableMultiSelectFilterTextfield' => true,
                'multiSelectFilterItems' => [
                    [
                        'image',
                        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.related_content.image',
                    ],
                    [
                        'typo3',
                        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.related_content.typo3',
                    ],
                ],
                'renderType' => 'selectMultipleSideBySide',
            ],
        ],
    ],
    'types' => [
        0 =>
            [
                'showitem' => 'hidden,title,poem,filename,season,weirdness,color,angle,--div--;LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.images,image1,image2,image3,image4,image5,image6,--div--;LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.relations,reference_page,related_records,related_content',
            ],
    ],
];
