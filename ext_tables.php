<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

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
        'after:email',
    );

    // Settings for new tables, which do not belong to Configuration/TCA

    // Define a new doktype
    $customPageDoktype = 116;
    // Add page type to system
    $dokTypeRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\DataHandling\PageDoktypeRegistry::class);
    $dokTypeRegistry->add(
        $customPageDoktype,
        [
            'type' => 'web',
            'allowedTables' => '*',
        ],
    );
})();
