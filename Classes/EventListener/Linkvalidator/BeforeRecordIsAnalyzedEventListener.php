<?php

declare(strict_types=1);

namespace T3docs\Examples\EventListener\Linkvalidator;

use TYPO3\CMS\Core\DataHandling\SoftReference\SoftReferenceParserFactory;
use TYPO3\CMS\Linkvalidator\Event\BeforeRecordIsAnalyzedEvent;
use TYPO3\CMS\Linkvalidator\Repository\BrokenLinkRepository;

final class BeforeRecordIsAnalyzedEventListener
{
    protected BrokenLinkRepository $brokenLinkRepository;
    protected SoftReferenceParserFactory $softReferenceParserFactory;
    public function __construct(
        BrokenLinkRepository $brokenLinkRepository,
        SoftReferenceParserFactory $softReferenceParserFactory
    ) {
        $this->brokenLinkRepository = $brokenLinkRepository;
        $this->softReferenceParserFactory = $softReferenceParserFactory;
    }

    private function addItemToBrokenLinkRepository(string $table, string $field, array $newsItem, string $foundUrl, string $forbiddenDomain): void
    {
        $link = [
            'record_uid' => $newsItem['uid'],
            'record_pid' => $newsItem['pid'],
            'language' => $newsItem['sys_language_uid'],
            'field' => $field,
            'table_name' => $table,
            'url' => $foundUrl,
            'last_check' => time(),
            'link_type' => 'external',
        ];
        $this->brokenLinkRepository->addBrokenLink($link, false, [
            'errorType' => 'exception',
            'exception' => 'Do not link externally to ' . $forbiddenDomain,
            'errno' => 42, ]);
    }

    private function findAllParsers(array $conf): iterable
    {
        return $this->softReferenceParserFactory->getParsersBySoftRefParserList($conf['softref'], ['subst']);
    }

    public function __invoke(BeforeRecordIsAnalyzedEvent $event): void
    {
        $table = $event->getTableName();
        $forbiddenDomain = 'example.org';
        if ($table !== 'tx_news_domain_model_news') {
            return;
        }
        $results = $event->getResults();
        $newsItem = $event->getRecord();
        if (!str_contains((string)$newsItem['bodytext'], $forbiddenDomain)) {
            return;
        }
        $field = 'bodytext';
        $conf = $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['bodytext']['config'];
        $results = $this->parseField(
            $conf,
            $table,
            $field,
            $newsItem,
            $forbiddenDomain,
            $results
        );
        $event->setResults($results);
    }

    private function parseField(
        array $conf,
        string $table,
        string $field,
        array $newsItem,
        string $forbiddenDomain,
        array $results
    ): array {
        foreach ($this->findAllParsers($conf) as $softReferenceParser) {
            $parserResult = $softReferenceParser->parse(
                $table,
                $field,
                $newsItem['uid'],
                $newsItem['bodytext']
            );
            if (!$parserResult->hasMatched()) {
                continue;
            }
            foreach ($parserResult->getMatchedElements() as $matchedElement) {
                if (!isset($matchedElement['subst'])) {
                    continue;
                }
                $results = $this->matchUrl(
                    (string)$matchedElement['subst']['tokenValue'],
                    $forbiddenDomain,
                    $table,
                    $field,
                    $newsItem,
                    $results
                );
            }
        }
        return $results;
    }

    private function matchUrl(
        string $foundUrl,
        string $forbiddenDomain,
        string $table,
        string $field,
        array $newsItem,
        array $results
    ): array {
        if (str_contains($foundUrl, $forbiddenDomain)) {
            $this->addItemToBrokenLinkRepository(
                $table,
                $field,
                $newsItem,
                $foundUrl,
                $forbiddenDomain
            );
            $results[] = $newsItem;
        }
        return $results;
    }
}
