<?php

return [
    'tools_ExamplesExample' => [
        'parent' => 'tools',
        'position' => ['after' => 'web_info'],
        'access' => 'admin',
        'workspaces' => 'live',
        'iconIdentifier' => 'module-example',
        'path' => '/module/tools/Example',
        'labels' => 'LLL:EXT:examples/Resources/Private/Language/locallang_mod.xlf',
        'extensionName' => 'Extkey',
        'controllerActions' => [
            MyExtbaseExampleModuleController::class => [
                'list',
                'detail'
            ],
        ],
    ],
];
