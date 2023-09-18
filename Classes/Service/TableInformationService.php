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

namespace T3docs\Examples\Service;

use TYPO3\CMS\Core\Database\ConnectionPool;

class TableInformationService
{
    public function __construct(
        protected readonly ConnectionPool $connectionPool,
    ) {}
    /**
     * Returns the count of available records from any table
     */
    public function countRecords(string $tablename = 'pages'): int
    {
        // TYPO3\CMS\Core\Database\Connection::count($item, $tableName) uses QueryBuilder internally
        // therefore it is safe to pass $tablename directly from the parameters to it.
        $connection = $this->connectionPool->getConnectionForTable($tablename);
        return $connection->count('uid', $tablename, []);
    }
}
