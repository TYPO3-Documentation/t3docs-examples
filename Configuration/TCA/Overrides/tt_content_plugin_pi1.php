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

use TYPO3\CMS\Core\Schema\Struct\SelectItem;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$pluginSignature = 'examples_pi1';

// Add the plugins to the list of plugins
ExtensionManagementUtility::addPlugin(
    new SelectItem(
        'select',
        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.examples_pi1',
        $pluginSignature,
        'content-plugin',
        'plugins',
    ),
    'FILE:EXT:examples/Configuration/Flexforms/flexform_ds1.xml',
);
