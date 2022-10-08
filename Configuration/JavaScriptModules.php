<?php

return [
    'dependencies' => [
        'core',
        'backend',
    ],
    'tags' => [
        'backend.module',
        'backend.navigation-component',
    ],
    'imports' => [
        '@t3docs/examples/' => 'EXT:examples/Resources/Public/JavaScript/',
    ],
];
