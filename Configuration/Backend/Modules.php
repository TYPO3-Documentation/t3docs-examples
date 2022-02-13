<?php

use T3docs\Examples\Controller\ModuleController;

/**
 * Definitions for modules provided by EXT:linkvalidator
 */
return [
    'web_linkvalidator' => [
        'parent' => 'web',
        'position' => ['after' => 'web_info'],
        'access' => 'user',
        'workspaces' => 'live',
        'path' => '/module/page/example',
        'labels' => 'LLL:EXT:examples/Resources/Private/Language/locallang_mod.xlf',
        'routes' => [
            '_default' => [
                'target' => ModuleController::class,
            ],
        ],
    ],
];
