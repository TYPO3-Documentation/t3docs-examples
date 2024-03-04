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
use T3docs\Examples\Service\StandaloneViewService;
use TYPO3\CMS\Core\Http\PropagateResponseException;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

final class DetailController
{
    /**
     * The back-reference to the mother cObj object set at call time
     */
    private ContentObjectRenderer $cObj;
    private array $conf = [];
    private StandaloneView $view;

    public function __construct(
        private readonly HaikuRepository $haikuRepository,
        private readonly FlexFormSettingsService $flexFormSettingsService,
        private readonly StandaloneViewService $viewService,
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
     * @throws PropagateResponseException
     */
    public function main(string $content, array $conf, ServerRequestInterface $request): string
    {
        $this->conf = $conf;
        $this->loadFlexFormSettings();
        $this->view = $this->viewService->createView($request, $this->conf, 'Haiku/Detail');

        $parameter = $request->getQueryParams()['tx_examples_haiku'] ?? [];
        $action = $parameter['action'] ?? '';
        try {
            return match ($action) {
                'show' => $this->showAction((int)($parameter['haiku'] ?? 0)),
                'findByTitle' => $this->findByTitleAction((string)($parameter['haiku_title'] ?? '')),
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
        );
    }

    private function showAction(int $haikuId): string
    {
        $this->view->assignMultiple([
            'haiku' => $this->haikuRepository->findByUid($haikuId),
        ]);
        return $this->view->render();
    }

    private function findByTitleAction(string $haikuTitle): string
    {
        $this->view->assignMultiple([
            'haiku' => $this->haikuRepository->findByTitle($haikuTitle),
        ]);
        return $this->view->render();
    }

    private function loadFlexFormSettings(): void
    {
        $this->conf['settings'] = $this->flexFormSettingsService->combineSettings(
            $this->conf['settings'] ?? [],
            $this->cObj->data['pi_flexform'] ?? '',
        );
    }
}
