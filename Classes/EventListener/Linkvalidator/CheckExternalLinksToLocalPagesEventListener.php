<?php

declare(strict_types=1);

namespace T3docs\Examples\EventListener\Linkvalidator;

use TYPO3\CMS\Core\DataHandling\SoftReference\SoftReferenceParserFactory;
use TYPO3\CMS\Linkvalidator\Event\BeforeRecordIsAnalyzedEvent;
use TYPO3\CMS\Linkvalidator\Repository\BrokenLinkRepository;

final class CheckExternalLinksToLocalPagesEventListener
{
    private const LOCAL_DOMAIN = 'example.org';
    private const TABLE_NAME = 'tt_content';
    private const FIELD_NAME = 'bodytext';

    private BrokenLinkRepository $brokenLinkRepository;
    private SoftReferenceParserFactory $softReferenceParserFactory;

    public function __construct(
        BrokenLinkRepository $brokenLinkRepository,
        SoftReferenceParserFactory $softReferenceParserFactory
    ) {
        $this->brokenLinkRepository = $brokenLinkRepository;
        $this->softReferenceParserFactory = $softReferenceParserFactory;
    }

    public function __invoke(BeforeRecordIsAnalyzedEvent $event): void
    {
        $table = $event->getTableName();
        if ($table !== self::TABLE_NAME) {
            return;
        }
        $results = $event->getResults();
        $record = $event->getRecord();
        $field = (string)$record[self::FIELD_NAME];
        if (!str_contains($field, self::LOCAL_DOMAIN)) {
            return;
        }
        $results = $this->parseField($record, $results);
        $event->setResults($results);
    }

    private function parseField(array $record, array $results): array
    {
        $conf = $GLOBALS['TCA'][self::TABLE_NAME]['columns'][self::FIELD_NAME]['config'];
        foreach ($this->findAllParsers($conf) as $softReferenceParser) {
            $parserResult = $softReferenceParser->parse(
                self::TABLE_NAME,
                self::FIELD_NAME,
                $record['uid'],
                (string)$record[self::FIELD_NAME]
            );
            if (!$parserResult->hasMatched()) {
                continue;
            }
            foreach ($parserResult->getMatchedElements() as $matchedElement) {
                if (!isset($matchedElement['subst'])) {
                    continue;
                }
                $this->matchUrl(
                    (string)$matchedElement['subst']['tokenValue'],
                    $record,
                    $results
                );
            }
        }
        return $results;
    }

    private function findAllParsers(array $conf): iterable
    {
        return $this->softReferenceParserFactory->getParsersBySoftRefParserList(
            $conf['softref'],
            ['subst']
        );
    }

    private function matchUrl(string $foundUrl, array $record, array &$results): void
    {
        if (str_contains($foundUrl, self::LOCAL_DOMAIN)) {
            $this->addItemToBrokenLinkRepository($record, $foundUrl);
            $results[] = $record;
        }
    }

    private function addItemToBrokenLinkRepository(array $record, string $foundUrl): void
    {
        $link = [
            'record_uid' => $record['uid'],
            'record_pid' => $record['pid'],
            'language' => $record['sys_language_uid'],
            'field' => self::FIELD_NAME,
            'table_name' => self::TABLE_NAME,
            'url' => $foundUrl,
            'last_check' => time(),
            'link_type' => 'external',
        ];
        $this->brokenLinkRepository->addBrokenLink($link, false, [
            'errorType' => 'exception',
            'exception' => 'Do not link externally to ' . self::LOCAL_DOMAIN,
            'errno' => 1661517573,
        ]);
    }
}
