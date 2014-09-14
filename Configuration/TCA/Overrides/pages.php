<?php
defined('TYPO3_MODE') or die();

// Modify General Record Storage Page selector to make it into a page tree
// USAGE: TCA Reference > $TCA array reference > ['columns'][field name]['config'] / TYPE: "select"
$tempConfiguration = array(
	'type' => 'select',
	'foreign_table' => 'pages',
	'size' => 10,
	'renderMode' => 'tree',
	'treeConfig' => array(
		'expandAll' => true,
		'parentField' => 'pid',
		'appearance' => array(
			'showHeader' => TRUE,
		),
	),
);

$GLOBALS['TCA']['pages']['columns']['storage_pid']['config'] = array_merge(
	$GLOBALS['TCA']['pages']['columns']['storage_pid']['config'],
	$tempConfiguration
);

// Add an extra categories selection field to the pages table
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
	'examples',
	'pages',
	// Do not use the default field name ("categories"), which is already used
	// Also do not use a field name containing "categories" (see http://forum.typo3.org/index.php/t/199595/)
	'tx_examples_cats',
	array(
		// Set a custom label
		'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:additional_categories',
		// This field should not be an exclude-field
		'exclude' => FALSE,
		// Override generic configuration, e.g. sort by title rather than by sorting
		'fieldConfiguration' => array(
			'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.title ASC',
		)
	)
);