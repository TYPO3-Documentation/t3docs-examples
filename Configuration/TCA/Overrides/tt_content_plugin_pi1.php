<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$pluginSignature = 'examples_pi1';
$pluginTitle = 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1';
$extensionKey = 'examples';

// Add the plugins to the list of plugins
ExtensionManagementUtility::addPlugin(
    [ $pluginTitle, $pluginSignature],
    'list_type',
    $extensionKey
);

// Disable the display of layout and select_key fields for the plugin
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature]
    = 'layout,select_key,pages';

// Activate the display of the plug-in flexform field and set FlexForm definition
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['examples_pi1'] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:examples/Configuration/Flexforms/flexform_ds1.xml'
);
