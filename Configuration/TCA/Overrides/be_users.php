<?php
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
