<?php

/*
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

return [
    'ctrl' => [
        'title' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku',
        'label' => 'title',
        'label_userFunc' => \T3docs\Examples\Userfuncs\Tca::class . '->haikuTitle',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'default_sortby' => 'ORDER BY title',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,poem',
        'security' => [
            // Allow the haiku table anywhere in the page tree
            'ignorePageTypeRestriction' => true,
        ],
        'typeicon_classes' => [
            'default' => 'tx_examples-haiku',
        ],
    ],
    'interface' => [
        'maxDBListItems' => 5,
        'maxSingleDBListItems' => 20,
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'description' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.hidden.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
        'title' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.title',
            'description' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.title.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'required' => true,
                'eval' => 'trim',
            ],
        ],
        'poem' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.poem',
            'description' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.poem.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 6,
                'softref' => 'typolink_tag,images,email[subst],url',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
            ],

        ],
        'image' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.images',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
                ],
            ],
        ],
        'season' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season',
            'description' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.season.description',
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
            'description' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.weirdness.description',
            'config' => [
                'type' => 'number',
                'size' => 10,
            ],
        ],
        'color' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.color',
            'description' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.color.description',
            'config' => [
                'type' => 'color',
                'size' => 10,
            ],
        ],
        'angle' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.angle',
            'config' => [
                'type' => 'number',
                'size' => 5,
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
                'showitem' => 'hidden,title,poem,image,season,weirdness,color,angle--div--;LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_haiku.relations,reference_page,related_records,related_content',
            ],
    ],
];
