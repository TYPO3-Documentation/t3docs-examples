<?php

declare(strict_types=1);

namespace T3docs\Examples\Domain\Repository;

use T3docs\Examples\Exception\NoSuchHaikuException;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\StringUtility;

class HaikuRepository
{
    private const TABLENAME = 'tx_examples_haiku';
    private Connection $connection;

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

    public function findByUid(int $uid): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        // $uid is an integer so we don't have to worry about SQL injections
        $where = $queryBuilder->expr()->eq('uid', $uid);
        $result = $queryBuilder->select('*')->from(self::TABLENAME)->where(
            $where
        )->executeQuery()->fetchAssociative();
        if (!$result) {
            throw new NoSuchHaikuException('Haiku with uid ' . $uid . 'not found.' );
        }
        return $result;
    }

    public function findByTitle(string $title): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        // Never use a string as parameter without running it
        // through createNamedParameter. This could cause SQL injections
        $where = $queryBuilder->expr()->eq(
            'title',
            $queryBuilder->createNamedParameter($title)
        );
        $result = $queryBuilder->select('*')->from(self::TABLENAME)->where(
            $where
        )->executeQuery()->fetchAssociative();
        if (!$result) {
            throw new NoSuchHaikuException('Haiku with title ' . htmlspecialchars($title) . 'not found.' );
        }
        return $result;
    }
}
