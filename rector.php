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

use Rector\Config\RectorConfig;
use Rector\Php74\Rector\LNumber\AddLiteralSeparatorToNumberRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/.',
    ]);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_82,
    ]);

    $rectorConfig->skip([
        // AddLiteralSeparatorToNumberRector would make the exception codes more readable.
        // But as they are just timestamps this is not needed/wanted.
        AddLiteralSeparatorToNumberRector::class,
        ReturnNeverTypeRector::class => [
            // We want to keep the ResponseInterface return type of indexAction() to be compatible
            // with the specification, although we just throw an exception for demonstration purpose.
            __DIR__ . '/Classes/Controller/ErrorController.php',
        ],
    ]);
};
