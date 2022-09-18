<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:examples/Resources/Private/Language/PluginHaiku/locallang_db.xlf:plugin.tx_examples_haiku.title',
        'examples_haiku'
    ],
    'list_type',
    'examples'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['examples_haiku']='pages,layout,select_key,recursive';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['examples_haiku']='pi_flexform';

ExtensionManagementUtility::addPiFlexFormValue(
    'examples_haiku',
    'FILE:EXT:examples/Configuration/Flexforms/PluginHaiku.xml'
);
