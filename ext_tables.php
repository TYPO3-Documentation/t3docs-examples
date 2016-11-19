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
            'Module' => 'flash,log,tree,clipboard,links,fileReference,fileReferenceCreate'
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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'be_users',
        $tempColumnsBackend,
        true
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'be_users',
        'tx_examples_mobile',
        '',
        'after:email'
);

$GLOBALS['TYPO3_USER_SETTINGS']['columns']['tx_examples_mobile'] = array(
        'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:be_users.tx_examples_mobile',
        'type' => 'text',
        'table' => 'be_users',
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToUserSettings(
        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:be_users.tx_examples_mobile,tx_examples_mobile',
        'after:email'
);


// New tables for demonstrating various TCA features


// Register sprite icons for news tables
/** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
        'tx_examples-dummy',
        \TYPO3\CMS\Core\Imaging\IconProvider\FontawesomeIconProvider::class,
        [
            'name' => 'flask'
        ]
);
$iconRegistry->registerIcon(
        'tx_examples-haiku',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:examples/Resources/Public/Images/Haiku.svg'
        ]
);
// Add sprite icon for new content element wizard
$iconRegistry->registerIcon(
        'tx_examples-error-plugin',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:examples/Resources/Public/Images/ErrorWizard.svg'
        ]
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
// Add sprite icon for new page type
$icons = array(
        'page-tree' => $relativeExtensionPath . 'Resources/Public/Images/PageTree.png'
);
\TYPO3\CMS\Backend\Sprite\SpriteManager::addSingleIcons($icons, $_EXTKEY);
