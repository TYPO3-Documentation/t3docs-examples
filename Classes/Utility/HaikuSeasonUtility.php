<?php

declare(strict_types=1);

namespace T3docs\Examples\Utility;

use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class HaikuSeasonUtility
{
    const SEASONS = ['spring', 'summer', 'autumn', 'winter', 'theFifthSeason'];
    const TRANSLATION_PATH = 'LLL:EXT:examples/Resources/Private/Language/PluginHaiku/locallang.xlf:season.';

    public static function getSeasons()
    {
        return self::SEASONS;
    }

    public static function getSeasonTranslation(string $season): string
    {
        $languageServiceFactory = GeneralUtility::makeInstance(
            LanguageServiceFactory::class
        );
        // As we are in a static context we cannot get the current request in another way
        $request = $GLOBALS['TYPO3_REQUEST'];
        $languageService = $languageServiceFactory->createFromSiteLanguage(
            $request->getAttribute('language')
            ?? $request->getAttribute('site')->getDefaultLanguage()
        );
        return $languageService->sL(self::TRANSLATION_PATH . $season);
    }
}
