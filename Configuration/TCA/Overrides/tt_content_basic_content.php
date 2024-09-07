<?php

declare(strict_types=1);

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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

call_user_func(function () {

    $key = 'examples_basiccontent';

    // Adds the content element to the "Type" dropdown
    ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            'label' => 'Example - basic content',
            'value' => $key,
            'group' => 'default',
        ],
        'textmedia',
        'after',
    );

    // Configure the default backend fields for the content element
    $GLOBALS['TCA']['tt_content']['types'][$key] = [
        'showitem' => '
            --palette--;;headers,
            bodytext,
        ',
    ];
});
