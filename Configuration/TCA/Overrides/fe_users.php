<?php

defined('TYPO3') or die();

// Add some fields to FE Users table to show TCA fields definitions
// USAGE: TCA Reference > $TCA array reference > ['columns'][fieldname]['config'] / TYPE: "select"
// USAGE TYPO3 Explained > Extension Architecture > Extending TCA > Examples
$temporaryColumns = [
    'tx_examples_options' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['', 0],
                ['LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.0', 1],
                ['LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.1', 2],
                ['LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.2', '--div--'],
                ['LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.3', 3],
            ],
            'size' => 1,
            'maxitems' => 1,
        ],
    ],
    'tx_examples_special' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_special',
        'config' => [
            'type' => 'user',
            // renderType needs to be registered in ext_localconf.php
            'renderType' => 'specialField',
            'parameters' => [
                'size' => '30',
                'color' => '#F49700',
            ],
        ],
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $temporaryColumns);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'tx_examples_options, tx_examples_special'
);
