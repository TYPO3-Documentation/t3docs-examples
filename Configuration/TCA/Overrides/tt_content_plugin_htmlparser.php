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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$extensionKey = 'Examples';
$pluginName = 'HtmlParser';
$pluginTitle = 'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:htmlparser_plugin_title';

// Register the HTML Parser plugin
$pluginSignature = ExtensionUtility::registerPlugin(
    $extensionKey,
    $pluginName,
    $pluginTitle,
);

// $pluginSignature == "examples_htmlparser"

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature]
    = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature]
    = 'pi_flexform';

// Configure FlexForm
ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:examples/Configuration/Flexforms/HtmlParser.xml',
);
