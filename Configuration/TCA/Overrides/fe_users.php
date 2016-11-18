<?php
defined('TYPO3_MODE') or die();

// Add some fields to FE Users table to show TCA fields definitions
// USAGE: TCA Reference > $TCA array reference > ['columns'][fieldname]['config'] / TYPE: "select"
$temporaryColumns = array(
        'tx_examples_options' => array(
                'exclude' => 0,
                'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options',
                'config' => array(
                        'type' => 'select',
                        'items' => array(
                                array(
                                        '',
                                        0
                                ),
                                array(
                                        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.0',
                                        1
                                ),
                                array(
                                        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.1',
                                        2
                                ),
                                array(
                                        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.2',
                                        '--div--'
                                ),
                                array(
                                        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_options.I.3',
                                        3
                                ),
                        ),
                        'size' => 1,
                        'maxitems' => 1,
                )
        ),
        'tx_examples_special' => array(
                'exclude' => 0,
                'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:fe_users.tx_examples_special',
                'config' => array(
                        'type' => 'user',
                        'userFunc' => \Documentation\Examples\Userfuncs\Tca::class . '->specialField',
                        'parameters' => array(
                                'size' => '30',
                                'color' => 'blue'
                        )
                )
        ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'fe_users',
        $temporaryColumns,
        true
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'fe_users',
        'tx_examples_options, tx_examples_special'
);