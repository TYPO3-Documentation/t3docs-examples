<?php

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

namespace T3docs\Examples\Controller\Haiku;

use Psr\Http\Message\ServerRequestInterface;
use T3docs\Examples\Domain\Repository\HaikuRepository;
use T3docs\Examples\Service\FlexFormSettingsService;
use TYPO3\CMS\Core\Attribute\AsAllowedCallable;
use TYPO3\CMS\Core\Http\PropagateResponseException;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\View\ViewFactoryData;
use TYPO3\CMS\Core\View\ViewFactoryInterface;
use TYPO3\CMS\Core\View\ViewInterface;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

final class DetailController
{
    /**
     * The back-reference to the mother cObj object set at call time
     */
    private ContentObjectRenderer $cObj;
    /** @var array<string, mixed> */
    private array $conf = [];

    public function __construct(
        private readonly HaikuRepository $haikuRepository,
        private readonly FlexFormSettingsService $flexFormSettingsService,
        private readonly ViewFactoryInterface $viewFactory,
    ) {}

    /**
     * This setter is called when the plugin is called from UserContentObject (USER)
     * via ContentObjectRenderer->callUserFunction().
     */
    public function setContentObjectRenderer(ContentObjectRenderer $cObj): void
    {
        $this->cObj = $cObj;
    }

    /**
     * @param array<string, mixed> $conf
     * @throws PropagateResponseException
     */
    #[AsAllowedCallable]
    public function main(string $content, array $conf, ServerRequestInterface $request): string
    {
        $this->conf = $conf;
        $this->loadFlexFormSettings();
        $viewFactoryData = new ViewFactoryData(
            templateRootPaths: ['EXT:examples/Resources/Private/Templates'],
            partialRootPaths: ['EXT:examples/Resources/Private/Partials'],
            layoutRootPaths: ['EXT:examples/Resources/Private/Layouts'],
            request: $request,
        );
        $view = $this->viewFactory->create($viewFactoryData);

        $parameter = $request->getQueryParams()['tx_examples_haiku'] ?? [];
        $action = $parameter['action'] ?? '';
        try {
            return match ($action) {
                'show' => $this->showAction($view, (int)($parameter['haiku'] ?? 0)),
                'findByTitle' => $this->findByTitleAction($view, (string)($parameter['haiku_title'] ?? '')),
                default => $this->notFoundAction('Action ' . $action . ' not found.'),
            };
        } catch (\Exception $e) {
            $this->notFoundAction($e->getMessage());
        }
    }

    /**
     * @throws PropagateResponseException
     */
    private function notFoundAction(string $reason): never
    {
        throw new PropagateResponseException(
            new Response(
                null,
                404,
                [],
                $reason,
            ),
            3819092385,
        );
    }

    private function showAction(ViewInterface $view, int $haikuId): string
    {
        $view->assignMultiple([
            'haiku' => $this->haikuRepository->findByUid($haikuId),
        ]);
        return $view->render('Haiku/Show');
    }

    private function findByTitleAction(ViewInterface $view, string $haikuTitle): string
    {
        $view->assignMultiple([
            'haiku' => $this->haikuRepository->findByTitle($haikuTitle),
        ]);
        return $view->render('Haiku/List');
    }

    private function loadFlexFormSettings(): void
    {
        $this->conf['settings'] = $this->flexFormSettingsService->combineSettings(
            $this->conf['settings'] ?? [],
            $this->cObj->data['pi_flexform'] ?? '',
        );
    }
}
