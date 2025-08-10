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

use TYPO3\CMS\Core\Schema\Struct\SelectItem;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::addPlugin(
    new SelectItem(
        'select',
        'LLL:EXT:examples/Resources/Private/Language/PluginHaiku/locallang_db.xlf:detail.title',
        'examples_haiku_detail',
        'tx_examples-haiku',
        'plugins',
        'LLL:EXT:examples/Resources/Private/Language/PluginHaiku/locallang_db.xlf:detail.description',
    ),
    'FILE:EXT:examples/Configuration/Flexforms/PluginHaikuDetail.xml',
);
