<?php

declare(strict_types=1);

namespace T3docs\Examples\Service;

use TYPO3\CMS\Core\Database\ConnectionPool;

class TableInformationService
{
    public function __construct(
        protected readonly ConnectionPool $connectionPool,
    ) {
    }
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
