<?php
/* $Id$ */
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$fullExtensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY);
$relativeExtensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY);

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
		'label' => 'LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_options',
		'config' => array (
			'type' => 'select',
			'items' => array (
				array('LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_options.I.0', '1'),
				array('LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_options.I.1', '2'),
				array('LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_options.I.2', '--div--'),
				array('LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_options.I.3', '3'),
			),
			'size' => 1,
			'maxitems' => 1,
		)
	),
	'tx_examples_special' => array (
		'exclude' => 0,
		'label' => 'LLL:EXT:examples/locallang_db.xml:fe_users.tx_examples_special',
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

// Load the full TCA
\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('tt_content');

// Add a "no print" checkbox
// USAGE: TCA Reference >  $TCA array reference > Extending the $TCA array
$temporaryColumn = array(
	'tx_examples_noprint' => array (
		'exclude' => 0,
		'label' => 'LLL:EXT:examples/locallang_db.xml:tt_content.tx_examples_noprint',
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
		'LLL:EXT:examples/locallang_db.xml:tt_content.list_type_pi1',
		$_EXTKEY . '_pi1'
	),
	'list_type'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:examples/locallang_db.xml:tt_content.list_type_pi2',
		$_EXTKEY . '_pi2'
	),
	'list_type'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:examples/locallang_db.xml:tt_content.list_type_pi3',
		$_EXTKEY . '_pi3'
	),
	'list_type'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:examples/locallang_db.xml:tt_content.list_type_pi4',
		$_EXTKEY . '_pi4'
	),
	'list_type'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:examples/locallang_db.xml:tt_content.list_type_pierror',
		$_EXTKEY . '_pierror'
	),
	'list_type'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:examples/locallang_db.xml:tt_content.list_type_pihtml',
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

// Add dummy table for TCA manipulations
// USAGE: TCA Reference > $TCA array reference > ['types'][key] section

// Allow it anywhere in the page tree
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_examples_dummy');

// Main TCA definition
$GLOBALS['TCA']['tx_examples_dummy'] = array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:examples/locallang_db.xml:tx_examples_dummy',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'type'		=> 'record_type',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => $fullExtensionPath . 'tca.php',
		'iconfile'          => $relativeExtensionPath . 'icon_tx_examples_dummy.gif',
	)
);

// Add another table for advanced TCA manipulations (special configuration, wizards)
// USAGE: TCA Reference > Additional $TCA features

// Allow it anywhere in the page tree
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_examples_haiku');

// Main TCA definition
$GLOBALS['TCA']['tx_examples_haiku'] = array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku',
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
		'dynamicConfigFile' => $fullExtensionPath . 'tca.php',
		'iconfile'          => $relativeExtensionPath . 'icon_tx_examples_haiku.gif',
	)
);

// Add context sensitive help (csh) for this table
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
	'tx_examples_haiku',
	$fullExtensionPath . 'locallang_csh_txexampleshaiku.xml'
);

// Declare static TS file
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
	$_EXTKEY,
	'static/',
	'Examples TypoScript'
);
?>