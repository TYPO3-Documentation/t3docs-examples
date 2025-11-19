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

use T3docs\Examples\Controller\AdminModuleController;
use T3docs\Examples\Controller\ModuleController;

/**
 * Definitions for modules provided by EXT:examples
 */
return [
    'content_examples' => [
        'parent' => 'content',
        'position' => ['after' => 'web_info'],
        'access' => 'user',
        'workspaces' => 'live',
        'path' => '/module/page/example',
        'labels' => 'examples.module.content_examples',
        'extensionName' => 'Examples',
        'iconIdentifier' => 'tx_examples-backend-module',
        'appearance' => [
            'dependsOnSubmodules' => true,
        ],
        'showSubmoduleOverview' => true,
        /*
        'controllerActions' => [
            ModuleController::class => [
                'flash', 'tree', 'clipboard', 'links', 'fileReference', 'fileReferenceCreate', 'count',
            ],
        ],
         */
    ],
    'content_examples_flash' => [
        'parent' => 'content_examples',
        'position' => ['before' => '*'],
        'access' => 'user',
        'workspaces' => 'live',
        'path' => '/module/page/example/flash',
        'labels' => 'examples.module.content_examples_flash',
        'extensionName' => 'Examples',
        'iconIdentifier' => 'tx_examples-backend-module',
        'controllerActions' => [
            ModuleController::class => [
                'flash',
            ],
        ],
    ],
    'content_examples_tree' => [
        'parent' => 'content_examples',
        'position' => ['after' => 'content_examples_flash'],
        'access' => 'user',
        'workspaces' => 'live',
        'path' => '/module/page/example/tree',
        'labels' => 'examples.module.content_examples_tree',
        'extensionName' => 'Examples',
        'iconIdentifier' => 'tx_examples-backend-module',
        'controllerActions' => [
            ModuleController::class => [
                'tree',
            ],
        ],
    ],
    'content_examples_clipboard' => [
        'parent' => 'content_examples',
        'position' => ['after' => 'content_examples_tree'],
        'access' => 'user',
        'workspaces' => 'live',
        'path' => '/module/page/example/clipboard',
        'labels' => 'examples.module.content_examples_clipboard',
        'extensionName' => 'Examples',
        'iconIdentifier' => 'tx_examples-backend-module',
        'controllerActions' => [
            ModuleController::class => [
                'clipboard',
            ],
        ],
    ],
    'content_examples_links' => [
        'parent' => 'content_examples',
        'position' => ['after' => 'content_examples_clipboard'],
        'access' => 'user',
        'workspaces' => 'live',
        'path' => '/module/page/example/links',
        'labels' => 'examples.module.content_examples_links',
        'extensionName' => 'Examples',
        'iconIdentifier' => 'tx_examples-backend-module',
        'controllerActions' => [
            ModuleController::class => [
                'links',
            ],
        ],
    ],
    'admin_examples' => [
        'parent' => 'system',
        'position' => ['top'],
        'access' => 'admin',
        'workspaces' => 'live',
        'path' => '/module/system/example',
        'labels' => 'LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang_mod.xlf',
        'iconIdentifier' => 'tx_examples-backend-module',
        'routes' => [
            '_default' => [
                'target' => AdminModuleController::class . '::handleRequest',
            ],
        ],
    ],
];
