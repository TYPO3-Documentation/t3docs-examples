<?php
defined('TYPO3_MODE') or die();

// Add a "no print" checkbox
// USAGE: TCA Reference >  $TCA array reference > Extending the $TCA array
$temporaryColumn = array(
        'tx_examples_noprint' => array(
                'exclude' => 0,
                'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.tx_examples_noprint',
                'config' => array(
                        'type' => 'check',
                )
        )
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'tt_content',
        $temporaryColumn,
        true
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'visibility',
        'tx_examples_noprint',
        'after:linkToTop'
);