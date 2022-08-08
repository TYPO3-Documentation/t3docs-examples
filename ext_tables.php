<?php
// Prevent Script from being called directly
defined('TYPO3') or die();

// encapsulate all locally defined variables
(function () {

    // Add examples BE module
    // This module is used to demonstrate some features and take screenshots
    // Register the backend module
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Examples',
        'tools', // Make module a submodule of 'Admin Tools'
        'examples', // Submodule key
        '', // Position
        [
            // An array holding the controller-action-combinations that are accessible
            \T3docs\Examples\Controller\ModuleController::class => 'flash,log,tree,debug,clipboard,password,links,fileReference,fileReferenceCreate',
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:examples/Resources/Public/Images/BackendModule.svg',
            'labels' => 'LLL:EXT:examples/Resources/Private/Language/locallang.xlf'
        ]
    );

    // Add extra fields to User Settings (field is defined for TCA too in Configuration/TCA/Overrides/be_users.php)
    // IMPORTANT: We need to define a dependency on sysext:setup to ensure that the loading order is correct and
    // the configuration is properly applied.
    $GLOBALS['TYPO3_USER_SETTINGS']['columns']['tx_examples_mobile'] = [
        'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:be_users.tx_examples_mobile',
        'type' => 'text',
        'table' => 'be_users',
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToUserSettings(
        'tx_examples_mobile',
        'after:email'
    );

    // Settings for new tables, which do not belong to Configuration/TCA

    // Allow dummy table anywhere in the page tree
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_examples_dummy');

    // Allow the haiku table anywhere in the page tree
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_examples_haiku');

    // Add context sensitive help (csh) for the haiku table
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
        'tx_examples_haiku',
        'EXT:examples/Resources/Private/Language/locallang_csh_txexampleshaiku.xlf'
    );

    // Define a new doktype
    $customPageDoktype = 116;
    $customIconClass = 'tx_examples-archive-page';
    // Add the new doktype to the list of page types
    $GLOBALS['PAGES_TYPES'][$customPageDoktype] = [
        'type' => 'sys',
        'icon' => $customIconClass,
        'allowedTables' => '*',
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        "@import 'EXT:examples/Configuration/TSconfig/Page/*.typoscript'"
    );
    // Add custom doktype to the page tree toolbar
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
        "@import 'EXT:examples/Configuration/TSconfig/User/*.typoscript'"
    );
})();
