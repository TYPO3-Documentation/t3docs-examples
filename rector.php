<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php70\Rector\Ternary\TernaryToNullCoalescingRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/.',
    ]);

    // register a single rule
    $rectorConfig->rule(TernaryToNullCoalescingRector::class);

    /*
        Apply all rules for a certain PHP version
        $rectorConfig->sets([
                LevelSetList::UP_TO_PHP_74
        ]);
    */
};
