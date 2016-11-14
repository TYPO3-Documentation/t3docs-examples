<?php
defined('TYPO3_MODE') or die();

$fullExtensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY);
$relativeExtensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY);

// Declare static TS file
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        $_EXTKEY,
        'Configuration/TypoScript/',
        'Examples TypoScript'
);


// Add examples BE module
// This module is used to demonstrate some features and take screenshots
// Register the backend module
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Documentation.' . $_EXTKEY,
        'tools', // Make module a submodule of 'Admin Tools'
        'examples', // Submodule key
        '', // Position
        array(
            // An array holding the controller-action-combinations that are accessible
            'Module' => 'flash,log,tree,clipboard,links'
        ),
        array(
                'access' => 'user,group',
                'icon' => 'EXT:' . $_EXTKEY . '/Resources/Public/Images/BackendModule.svg',
                'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml',
                'navigationComponentId' => 'typo3-navigation'
        )
);
// Register the navigation component
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addNavigationComponent(
        'tools_Examples',
        'typo3-navigation'
);

$GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses'][] = array(
        'name' => 'Documentation\\Examples\\Service\\ContextMenuOptions'
);
$icons = array(
        'page-tree' => $relativeExtensionPath . 'Resources/Public/Images/PageTree.png'
);
\TYPO3\CMS\Backend\Sprite\SpriteManager::addSingleIcons($icons, $_EXTKEY);

// Add extra fields to User Settings and be_user TCA fields

$tempColumnsBackend = array(
        'tx_examples_mobile' => array(
                'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:be_users.tx_examples_mobile',
                'config' => array(
                        'type' => 'input',
                        'size' => 30
                )
        )
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('be_users', $tempColumnsBackend, true);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('be_users', 'tx_examples_mobile', '',
        'after:email');

$GLOBALS['TYPO3_USER_SETTINGS']['columns']['tx_examples_mobile'] = array(
        'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:be_users.tx_examples_mobile',
        'type' => 'text',
        'table' => 'be_users',
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToUserSettings('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:be_users.tx_examples_mobile,tx_examples_mobile',
        'after:email');

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
        $_EXTKEY . '_pi1', 'FILE:EXT:examples/Configuration/Flexforms/flexform_ds1.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi2'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        $_EXTKEY . '_pi2', 'FILE:EXT:examples/Configuration/Flexforms/flexform_ds2.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi3'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        $_EXTKEY . '_pi3', 'FILE:EXT:examples/Configuration/Flexforms/flexform_ds3.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi4'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        $_EXTKEY . '_pi4', 'FILE:EXT:examples/Configuration/Flexforms/flexform_ds4.xml'
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

// Register the HTML Parser plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        $_EXTKEY,
        'HtmlParser',
        'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xlf:htmlparser_plugin_title'
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


// New tables for demonstrating various TCA features

// Add table icons to sprite
\TYPO3\CMS\Backend\Sprite\SpriteManager::addSingleIcons(
        array(
                'dummy-default' => $relativeExtensionPath . 'Resources/Public/Images/Dummy.png',
                'haiku-default' => $relativeExtensionPath . 'Resources/Public/Images/Haiku.png'
        ),
        $_EXTKEY
);

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
