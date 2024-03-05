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

defined('TYPO3') or die();

// Add a "related pages" field to demonstrate select-type fields with tree rendering
// USAGE: TCA Reference > $TCA array reference > ['columns'][field name]['config'] / TYPE: "select"
// https://docs.typo3.org/m/typo3/reference-tca/master/en-us/ColumnsConfig/Type/Select/Index.html#columns-select
$temporaryColumn = [
    'tx_examples_related_pages' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:pages.tx_examples_related_pages',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectTree',
            'foreign_table' => 'pages',
            'foreign_table_where' => 'ORDER BY pages.sorting',
            'size' => 20,
            'items' => [
                [
                    'label' => 'static from tca 4711',
                    'value' => 4711,
                ],
                [
                    'label' => 'static from tca 4712',
                    'value' => 4712,
                ],
            ],
            'treeConfig' => [
                'parentField' => 'pid',
                'appearance' => [
                    'expandAll' => true,
                    'showHeader' => true,
                ],
            ],
        ],
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $temporaryColumn);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'pages',
    'media',
    '--linebreak--,tx_examples_related_pages',
    'after:media',
);

// SAME as registered in ext_tables.php
$customPageDoktype = 116;
$customIconClass = 'tx_examples-archive-page';

// Add the new doktype to the page type selector
$GLOBALS['TCA']['pages']['columns']['doktype']['config']['items'][] = [
    'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:archive_page_type',
    $customPageDoktype,
    $customIconClass,
];
// Add the icon to the icon class configuration
$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes'][$customPageDoktype] = $customIconClass;
