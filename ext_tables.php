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

// Register the context menu item
$GLOBALS['TBE_MODULES_EXT']['xMOD_alt_clickmenu']['extendCMclasses'][] = array(
        'name' => \Documentation\Examples\Service\ContextMenuOptions::class
);

// Add extra fields to User Settings (field is defined for TCA too in Configuration/TCA/Overrides/be_users.php)
$GLOBALS['TYPO3_USER_SETTINGS']['columns']['tx_examples_mobile'] = array(
        'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:be_users.tx_examples_mobile',
        'type' => 'text',
        'table' => 'be_users',
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToUserSettings(
        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:be_users.tx_examples_mobile,tx_examples_mobile',
        'after:email'
);

// Register sprite icons (for news tables, click-menu items, etc.)
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
// Add sprite icon for the context menu item
$iconRegistry->registerIcon(
        'tx_examples-page-tree',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:examples/Resources/Public/Images/PageTree.svg'
        ]
);

// Settings for new tables, which do not belong to Configuration/TCA

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
$customIconClass = 'tx_examples-archive-page';
// Add sprite icon for the context menu item
$iconRegistry->registerIcon(
        $customIconClass,
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:examples/Resources/Public/Images/ArchivePage.svg'
        ]
);
// Add the new doktype to the list of page types
$GLOBALS['PAGES_TYPES'][$customPageDoktype] = array(
        'type' => 'sys',
        'icon' => $customIconClass,
        'allowedTables' => '*'
);
// NOTE: all TCA modifications could be stored to Configuration/TCA/Overrides/pages.php,
// but that would force duplication of icon declaration, etc.
// Add the new doktype to the page type selector
$GLOBALS['TCA']['pages']['columns']['doktype']['config']['items'][] = array(
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:archive_page_type',
        $customPageDoktype,
        $customIconClass
);
// Also add the new doktype to the page language overlays type selector (so that translations can inherit the same type)
$GLOBALS['TCA']['pages_language_overlay']['columns']['doktype']['config']['items'][] = array(
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:archive_page_type',
        $customPageDoktype,
        $customIconClass
);
// Add the icon to the icon class configuration
$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes'][$customPageDoktype] = $customIconClass;
// Add the new doktype to the list of types available from the new page menu at the top of the page tree
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
        'options.pageTree.doktypesToShowInNewPageDragArea := addToList(' . $customPageDoktype . ')'
);
