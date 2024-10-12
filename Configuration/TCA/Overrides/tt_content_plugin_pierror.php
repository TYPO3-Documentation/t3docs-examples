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
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

// Register the "error" plugin
ExtensionUtility::registerPlugin(
    'Examples',
    'Error',
    'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.example_pierror',
    null,
    'plugins',
    'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:pierror_wizard_description',
);
