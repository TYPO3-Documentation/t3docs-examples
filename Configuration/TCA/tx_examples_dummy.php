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
        'title' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'type' => 'record_type',
        'default_sortby' => 'ORDER BY title',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'security' => [
            // Allow the dummy table anywhere in the page tree
            'ignorePageTypeRestriction' => true,
        ],
        'typeicon_classes' => [
            'default' => 'tx_examples-dummy',
        ],
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
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
        'record_type' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.record_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.record_type.0', 0],
                    ['LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.record_type.1', 1],
                    ['LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.record_type.2', 2],
                ],
            ],
        ],
        'title' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'required' => true,
                'eval' => 'trim',
            ],
        ],
        'some_date' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.some_date',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'size' => 12,
            ],
        ],
        'enforce_date' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.enforce_date',
            'config' => [
                'type' => 'check',
            ],
        ],
        'description' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tx_examples_dummy.description',
            'config' => [
                'type' => 'text',
                'cols' => 50,
                'rows' => 3,
            ],
        ],
    ],
    'types' => [
        // NOTE: there are alternate versions of this row to demonstrate various features
        //		'0' => array('showitem' => 'hidden, record_type, title, some_date '),
        // Use this row to demonstrate usage of palettes
        '0' => ['showitem' => 'hidden, record_type, title, some_date, description, --palette--;;1'],
        // Use this row when discussing special configuration nowrap
        // (paste this into the description field: This is a very long text that will not wrap when I get to the end of the box, which is very far away, away, away, away, away, away)
        //		'0' => array('showitem' => 'hidden, record_type, title, description;;;nowrap, some_date;;1 '),
        // Additional types
        '1' => ['showitem' => 'record_type, title '],
        '2' => ['showitem' => 'title, some_date, hidden, record_type '],
    ],
    'palettes' => [
        '1' => ['showitem' => 'enforce_date'],
    ],
];
