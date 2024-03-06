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

namespace T3docs\Examples\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;

/**
 * This middleware can be used to retrieve a list of seasons with their according translation.
 * To get the correct translation the URL must be within a base path defined in site
 * handling. Some examples:
 * "/en/haiku-season-list.json" for English translation (if /en is the configured base path)
 * "/de/haiku-season-list.json" for German translation (if /de is the configured base path)
 * If the base path is not available in the according site the default language will be used.
 */
final readonly class HaikuSeasonList implements MiddlewareInterface
{
    private const SEASONS = ['spring', 'summer', 'autumn', 'winter', 'theFifthSeason'];
    private const TRANSLATION_PATH = 'LLL:EXT:examples/Resources/Private/Language/PluginHaiku/locallang.xlf:season.';
    private const URL_SEGMENT = '/haiku-season-list.json';

    public function __construct(
        private LanguageServiceFactory $languageServiceFactory,
        private ResponseFactoryInterface $responseFactory,
        private StreamFactoryInterface $streamFactory,
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!str_contains($request->getUri()->getPath(), self::URL_SEGMENT)) {
            return $handler->handle($request);
        }

        $seasons = json_encode($this->getSeasons($request), JSON_THROW_ON_ERROR);

        return $this->responseFactory->createResponse()
            ->withHeader('Content-Type', 'application/json')
            ->withBody($this->streamFactory->createStream($seasons));
    }

    private function getSeasons(ServerRequestInterface $request): array
    {
        $languageService = $this->languageServiceFactory->createFromSiteLanguage(
            $request->getAttribute('language') ?? $request->getAttribute('site')->getDefaultLanguage(),
        );

        $translatedSeasons = [];
        foreach (self::SEASONS as $season) {
            $translatedSeasons[$season] = $languageService->sL(self::TRANSLATION_PATH . $season);
        }

        return $translatedSeasons;
    }
}
