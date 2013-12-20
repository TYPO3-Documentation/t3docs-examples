<?php
/* $Id$ */
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$fullExtensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY);
$relativeExtensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY);

// Declare static TS file
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
	$_EXTKEY,
	'static/',
	'Examples TypoScript'
);


// Add examples BE module
// This module is used to demonstrate some features and take screenshots
// Avoid loading the module when in the frontend or the Install Tool
if (TYPO3_MODE == 'BE' && !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)) {
	// Register the backend module
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Documentation.' . $_EXTKEY,
		'tools', // Make module a submodule of 'Admin Tools'
		'examples', // Submodule key
		'', // Position
		array(
			// An array holding the controller-action-combinations that are accessible
			'Default' => 'flash,log,tree,clipboard,links'
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/Resources/Public/Images/moduleIcon.png',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml',
			'navigationComponentId' => 'typo3-navigation'
		)
	);
	// Register the navigation component
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addNavigationComponent(
		'tools_Examples',
		'typo3-navigation'
	);
}

if (TYPO3_MODE == 'BE') {
	$GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses'][] = array(
		'name' => 'Documentation\\Examples\\Service\\ContextMenuOptions'
	);
	$icons = array(
		'page-tree' => $relativeExtensionPath . 'Resources/Public/Images/PageTree.png'
	);
	\TYPO3\CMS\Backend\Sprite\SpriteManager::addSingleIcons($icons, $_EXTKEY);
}


// Add some fields to FE Users table to show TCA fields definitions
// USAGE: TCA Reference > $TCA array reference > ['columns'][fieldname]['config'] / TYPE: "select"
$temporaryColumns = array (
	'tx_examples_options' => array (
		'exclude' => 0,
		'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options',
		'config' => array (
			'type' => 'select',
			'items' => array (
				array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.0', '1'),
				array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.1', '2'),
				array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.2', '--div--'),
				array('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.3', '3'),
			),
			'size' => 1,
			'maxitems' => 1,
		)
	),
	'tx_examples_special' => array (
		'exclude' => 0,
		'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_special',
		'config' => array (
			'type' => 'user',
			'size' => '30',
			'userFunc' => 'Documentation\\Examples\\Userfuncs\\Tca->specialField',
			'parameters' => array(
				'color' => 'blue'
			)
		)
	),
);

\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('fe_users');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
	'fe_users',
	$temporaryColumns,
	1
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'fe_users',
	'tx_examples_options;;;;1-1-1, tx_examples_special'
);


// Add a "no print" checkbox
// USAGE: TCA Reference >  $TCA array reference > Extending the $TCA array
$temporaryColumn = array(
	'tx_examples_noprint' => array (
		'exclude' => 0,
		'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.tx_examples_noprint',
		'config' => array (
			'type' => 'check',
		)
	)
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
	'tt_content',
	$temporaryColumn,
	1
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
	'tt_content',
	'visibility',
	'tx_examples_noprint',
	'after:linkToTop'
);


// Create various FE plugins to demonstrate FlexForms definition
// USAGE: TCA Reference > $TCA array reference > ['columns'][fieldname]['config'] / TYPE: "flex"

// Disable the display of layout and select_key fields for the plugins
// provided by the extension
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi2'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi3'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi4'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pierror'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pihtml'] = 'layout,select_key,pages';

// Activate the display of the plug-in flexform field and set FlexForm definition
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
	$_EXTKEY . '_pi1', 'FILE:EXT:examples/flexforms/flexform_ds1.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi2'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
	$_EXTKEY . '_pi2', 'FILE:EXT:examples/flexforms/flexform_ds2.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi3'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
	$_EXTKEY . '_pi3', 'FILE:EXT:examples/flexforms/flexform_ds3.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi4'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
	$_EXTKEY . '_pi4', 'FILE:EXT:examples/flexforms/flexform_ds4.xml'
);

// Add the plugins to the list of plugins
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1',
		$_EXTKEY . '_pi1'
	),
	'list_type'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi2',
		$_EXTKEY . '_pi2'
	),
	'list_type'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi3',
		$_EXTKEY . '_pi3'
	),
	'list_type'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi4',
		$_EXTKEY . '_pi4'
	),
	'list_type'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pierror',
		$_EXTKEY . '_pierror'
	),
	'list_type'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pihtml',
		$_EXTKEY . '_pihtml'
	),
	'list_type'
);
// Register the collections plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Collections',
	'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xlf:collections_plugin_title'
);

// Add "pierror" plugin to new element wizard
if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_examples_pierror_wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'pierror/class.tx_examples_pierror_wizicon.php';
}


// Modify General Record Storage Page selector to make it into a page tree
// USAGE: TCA Reference > $TCA array reference > ['columns'][field name]['config'] / TYPE: "select"
\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('pages');
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

// New tables for demonstrating various TCA features

// Allow dummy table anywhere in the page tree
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_examples_dummy');

// Allow the haiku table anywhere in the page tree
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_examples_haiku');

// Add context sensitive help (csh) for the haiku table
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
	'tx_examples_haiku',
	$fullExtensionPath . 'Resources/Private/Language/locallang_csh_txexampleshaiku.xml'
);


// Define a new doktype
$customPageDoktype = 116;
$customPageIcon = $relativeExtensionPath . 'Resources/Public/Images/Archive.png';
// Add the new doktype to the list of page types
$GLOBALS['PAGES_TYPES'][$customPageDoktype] = array(
	'type' => 'sys',
	'icon' => $customPageIcon,
	'allowedTables' => '*'
);
// Add the new doktype to the page type selector
$GLOBALS['TCA']['pages']['columns']['doktype']['config']['items'][] = array(
	'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:archive_page_type',
	$customPageDoktype,
	$customPageIcon
);
// Also add the new doktype to the page language overlays type selector (so that translations can inherit the same type)
$GLOBALS['TCA']['pages_language_overlay']['columns']['doktype']['config']['items'][] = array(
	'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:archive_page_type',
	$customPageDoktype,
	$customPageIcon
);
// Add the icon for the new doktype
\TYPO3\CMS\Backend\Sprite\SpriteManager::addTcaTypeIcon('pages', $customPageDoktype, $customPageIcon);
// Add the new doktype to the list of types available from the new page menu at the top of the page tree
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
	'options.pageTree.doktypesToShowInNewPageDragArea := addToList(' . $customPageDoktype . ')'
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
		// Override generic configuration, e.g. sort by title rather than by sorting
		'fieldConfiguration' => array(
			'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.title ASC',
		)
	)
);
?>