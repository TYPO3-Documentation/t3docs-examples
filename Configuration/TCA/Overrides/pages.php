<?php
defined('TYPO3_MODE') or die();

$langFile = 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf';

// Add a "related pages" field to demonstrate select-type fields with tree rendering
// USAGE: TCA Reference > $TCA array reference > ['columns'][field name]['config'] / TYPE: "select"
// https://docs.typo3.org/m/typo3/reference-tca/master/en-us/ColumnsConfig/Type/Select/Index.html#columns-select
$temporaryColumn = [
    'tx_examples_related_pages' => [
        'exclude' => 0,
        'label' => $langFile . ':pages.tx_examples_related_pages',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectTree',
            'foreign_table' => 'pages',
            'foreign_table_where' => 'ORDER BY pages.sorting',
            'size' => 20,
            'items' => [
                ['static from tca 4711', 4711],
                ['static from tca 4712', 4712],
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
    'tx_examples_import_data_control' => [
        'label'   => $langFile . ':pages.tx_examples_import_data_control',
        'config'  => [
            'type' => 'input',
            'eval' => 'int, unique',
            'fieldControl' => [
                'importControl' => [
                    'renderType' => 'importDataControl'
                ]
            ]
        ]
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $temporaryColumn);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'pages',
    'media',
    '--linebreak--,tx_examples_related_pages',
    'after:media'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'pages',
    'tx_examples_import_data_control'
);

// Add an extra categories selection field to the pages table
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    'examples',
    'pages',
    // Do not use the default field name ("categories"), which is already used
    'tx_examples_cats',
    [
        // Set a custom label
        'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:additional_categories',
        // This field should not be an exclude-field
        'exclude' => false,
        // Override generic configuration, e.g. sort by title rather than by sorting
        'fieldConfiguration' => [
            'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.title ASC',
        ],
    ]
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
// Add the new doktype to the list of types available from the new page menu at the top of the page tree
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
    'options.pageTree.doktypesToShowInNewPageDragArea := addToList(' . $customPageDoktype . ')'
);
