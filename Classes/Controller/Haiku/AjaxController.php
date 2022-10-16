<?php

namespace T3docs\Examples\Controller\Haiku;

use Psr\Http\Message\ServerRequestInterface;
use T3docs\Examples\Domain\Repository\HaikuRepository;
use T3docs\Examples\Service\FlexFormSettingsService;
use T3docs\Examples\Service\StandaloneViewService;
use T3docs\Examples\Utility\HaikuSeasonUtility;
use TYPO3\CMS\Core\Http\PropagateResponseException;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class AjaxController
{
    public array $conf = [];
    private LanguageService $languageService;

    public function __construct(
        private readonly LanguageServiceFactory $languageServiceFactory,
    ) {
    }

    private function getLanguageService(ServerRequestInterface $request): LanguageService {
        return $this->languageServiceFactory->createFromSiteLanguage(
            $request->getAttribute('language')
            ?? $request->getAttribute('site')->getDefaultLanguage()
        );
    }

    public function main(string $content, array $conf, ServerRequestInterface $request): string
    {
        $this->conf = $conf;
        $this->languageService = $this->getLanguageService($request);

        $parameter = $request->getQueryParams()['tx_examples_haiku']??[];
        $action = $parameter['action'] ?? '';
        try {
            $result = match ($action) {
                'getSeasonList' => $this->getTranslatedSeasonListAction(),
                'translateSeason' => $this->translateSeasonAction($parameter['season'] ?? ''),
                default => $this->notFoundAction('Action ' . $action . ' not found.'),
            };
        } catch (\Exception $e) {
            $result = json_encode(
                [
                    'error' => $e::class,
                    'errorMessage' => $e->getMessage(),
                ]);
        }
        return $result;
    }

    private function getTranslatedSeasonListAction() : string {
        $seasons = HaikuSeasonUtility::getSeasons();
        $translatedSeasons = [];
        foreach ($seasons as $season) {
            $translatedSeasons[$season] =
                $this->languageService->getLL(
                    HaikuSeasonUtility::TRANSLATION_PATH .$season
                );
        }
        return json_encode($translatedSeasons);
    }

    private function translateSeasonAction(string $season) {
        if (!in_array($season, HaikuSeasonUtility::getSeasons())) {
            $this->notFoundAction('Season ' . $season . ' not found');
        }
        return HaikuSeasonUtility::getSeasonTranslation($season);
    }

    /**
     * @throws PropagateResponseException
     */
    private function notFoundAction(string $reason)
    {
        throw new \RuntimeException($reason);
    }
}
