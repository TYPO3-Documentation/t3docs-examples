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

namespace T3docs\Examples\Domain\Repository;

use T3docs\Examples\Exception\NoSuchHaikuException;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;

class HaikuRepository
{
    private const TABLENAME = 'tx_examples_haiku';
    private readonly Connection $connection;

    public function __construct(
        ConnectionPool $connectionPool,
    ) {
        $this->connection = $connectionPool->getConnectionForTable(self::TABLENAME);
    }

    public function findAll(): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $result = $queryBuilder->select('*')->from(self::TABLENAME)->executeQuery();
        return $result->fetchAllAssociative();
    }

    /**
     * @throws NoSuchHaikuException
     */
    public function findByUid(int $uid): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        // $uid is an integer so we don't have to worry about SQL injections
        $where = $queryBuilder->expr()->eq('uid', $uid);
        $result = $queryBuilder->select('*')->from(self::TABLENAME)->where(
            $where,
        )->executeQuery()->fetchAssociative();
        if (!$result) {
            throw new NoSuchHaikuException('Haiku with uid ' . $uid . 'not found.', 1664390495);
        }
        return $result;
    }

    /**
     * @throws NoSuchHaikuException
     */
    public function findByTitle(string $title): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        // Never use a string as parameter without running it
        // through createNamedParameter. This could cause SQL injections
        $where = $queryBuilder->expr()->eq(
            'title',
            $queryBuilder->createNamedParameter($title),
        );
        $result = $queryBuilder->select('*')->from(self::TABLENAME)->where(
            $where,
        )->executeQuery()->fetchAssociative();
        if (!$result) {
            throw new NoSuchHaikuException('Haiku with title ' . htmlspecialchars($title) . 'not found.', 1664390496);
        }
        return $result;
    }
}
