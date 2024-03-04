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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:examples/Resources/Private/Language/PluginHaiku/locallang_db.xlf:detail.title',
        'examples_haiku_detail',
        'tx_examples-haiku',
    ],
    'list_type',
    'examples',
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['examples_haiku_detail'] = 'pages,layout,select_key,recursive';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['examples_haiku_detail'] = 'pi_flexform';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'examples_haiku_detail',
    'FILE:EXT:examples/Configuration/Flexforms/PluginHaikuDetail.xml',
);
