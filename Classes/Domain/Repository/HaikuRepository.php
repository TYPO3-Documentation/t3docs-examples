<?php

declare(strict_types=1);

namespace T3docs\Examples\Domain\Repository;

use TYPO3\CMS\Core\Database\ConnectionPool;

class HaikuRepository
{
    public function __construct(
        protected readonly ConnectionPool $connectionPool,
    ) {
    }

    public function findAll(): array
    {
        $queryBuilder = $this->connectionPool->getConnectionForTable('tx_examples_haiku')->createQueryBuilder();
        $result = $queryBuilder->select('*')->from('tx_examples_haiku')->executeQuery();
        return $result->fetchAllAssociative();
    }

    public function findByUid(int $uid): array
    {
        $queryBuilder = $this->connectionPool->getConnectionForTable('tx_examples_haiku')->createQueryBuilder();
        // $uid is an integer so we don't have to worry about SQL injections
        $where = $queryBuilder->expr()->eq('uid', $uid);
        $result = $queryBuilder->select('*')->from('tx_examples_haiku')->where(
            $where
        )->executeQuery();
        return $result->fetchAssociative() ?? [];
    }

    public function findByTitle(string $title): array
    {
        $queryBuilder = $this->connectionPool->getConnectionForTable('tx_examples_haiku')->createQueryBuilder();
        // Never use a string as parameter without running it
        // through createNamedParameter. This could cause SQL injections
        $where = $queryBuilder->expr()->eq(
            'title',
            $queryBuilder->createNamedParameter($title)
        );
        $result = $queryBuilder->select('*')->from('tx_examples_haiku')->where(
            $where
        )->executeQuery();
        return $result->fetchAssociative() ?? [];
    }
}
