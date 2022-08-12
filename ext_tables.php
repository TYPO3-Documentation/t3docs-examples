<?php
// Prevent Script from being called directly
defined('TYPO3') or die();

// encapsulate all locally defined variables
(function () {

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

    // Define a new doktype
    $customPageDoktype = 116;
    $customIconClass = 'tx_examples-archive-page';
    // Add the new doktype to the list of page types
    $GLOBALS['PAGES_TYPES'][$customPageDoktype] = [
        'type' => 'sys',
        'icon' => $customIconClass,
        'allowedTables' => '*',
    ];

    // Add custom doktype to the page tree toolbar
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
        "@import 'EXT:examples/Configuration/TsConfig/User/*.tsconfig'"
    );
})();
