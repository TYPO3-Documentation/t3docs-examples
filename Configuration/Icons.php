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

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'tx_examples-dummy' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:examples/Resources/Public/Images/Flask.svg',
    ],
    'tx_examples-haiku' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:examples/Resources/Public/Images/Haiku.svg',
    ],
    'tx_examples-error-plugin' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:examples/Resources/Public/Images/ErrorWizard.svg',
    ],
    'tx_examples-page-tree' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:examples/Resources/Public/Images/PageTree.svg',
    ],
    'tx_examples-archive-page' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:examples/Resources/Public/Images/ArchivePage.svg',
    ],
    'tx_examples-backend-module' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:examples/Resources/Public/Images/BackendModule.svg',
    ],
];
