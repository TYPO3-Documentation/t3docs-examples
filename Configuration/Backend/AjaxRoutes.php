<?php

return [
    'tx_examples_count' => [
        'path' => '/examples/module/count',
        'target' => \T3docs\Examples\Controller\ModuleController::class . '::countAction',
    ],
];
