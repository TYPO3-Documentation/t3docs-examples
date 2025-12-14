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

defined('TYPO3') || die();

use TYPO3\CMS\Core\Schema\Struct\SelectItem;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$pluginSignature = 'examples_pi4';

// Add the plugins to the list of plugins
ExtensionManagementUtility::addPlugin(
    new SelectItem(
        'select',
        'LLL:examples.db:tt_content.examples_pi4',
        $pluginSignature,
        'content-plugin',
        'plugins',
    ),
    'FILE:EXT:examples/Configuration/Flexforms/flexform_ds4.xml',
);
