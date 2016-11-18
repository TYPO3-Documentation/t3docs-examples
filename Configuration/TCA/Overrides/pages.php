<?php
defined('TYPO3_MODE') or die();

// Add a "related pages" field to demonstrate select-type fields with tree rendering
// USAGE: TCA Reference > $TCA array reference > ['columns'][field name]['config'] / TYPE: "select"
// https://docs.typo3.org/typo3cms/TCAReference/Reference/Columns/Select/Index.html#render-the-general-record-storage-page-selector-as-a-tree-of-page
$temporaryColumn = array(
        'tx_examples_related_pages' => array(
                'exclude' => 0,
                'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:pages.tx_examples_related_pages',
                'config' => array(
                        'type' => 'select',
                        'foreign_table' => 'pages',
                        'size' => 10,
                        'renderMode' => 'tree',
                        'treeConfig' => array(
                                'expandAll' => true,
                                'parentField' => 'pid',
                                'appearance' => array(
                                        'showHeader' => true,
                                ),
                        ),
                )
        )
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'pages',
        $temporaryColumn
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'pages',
        'media',
        '--linebreak--,tx_examples_related_pages',
        'after:media'
);

// Add an extra categories selection field to the pages table
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
        'examples',
        'pages',
        // Do not use the default field name ("categories"), which is already used
        'tx_examples_cats',
        array(
            // Set a custom label
            'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:additional_categories',
            // This field should not be an exclude-field
            'exclude' => false,
            // Override generic configuration, e.g. sort by title rather than by sorting
            'fieldConfiguration' => array(
                    'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.title ASC',
            )
        )
);