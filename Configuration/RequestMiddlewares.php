<?php

return [
    'frontend' => [
        't3docs/examples/haiku-season-list' => [
            'target' => \T3docs\Examples\Middleware\HaikuSeasonList::class,
            'before' => [
                'typo3/cms-frontend/maintenance-mode',
            ],
            'after' => [
                'typo3/cms-frontend/site',
            ],
        ],
    ],
];
