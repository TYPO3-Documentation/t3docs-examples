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
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

final class ListController
{
    /**
     * The back-reference to the mother cObj object set at call time
     */
    private ContentObjectRenderer $cObj;
    private array $conf = [];

    public function __construct(
        private readonly HaikuRepository $haikuRepository,
        private readonly FlexFormSettingsService $flexFormSettingsService,
        private readonly StandaloneViewService $viewService,
    ) {}

    public function main(string $content, array $conf, ServerRequestInterface $request): string
    {
        $this->conf = $conf;
        $this->loadFlexFormSettings();
        $view = $this->viewService->createView($request, $this->conf, 'Haiku/List');
        $view->assignMultiple([
            'haikus' => $this->haikuRepository->findAll(),
        ]);
        return $view->render();
    }

    /**
     * This setter is called when the plugin is called from UserContentObject (USER)
     * via ContentObjectRenderer->callUserFunction().
     */
    public function setContentObjectRenderer(ContentObjectRenderer $cObj): void
    {
        $this->cObj = $cObj;
    }

    private function loadFlexFormSettings(): void
    {
        $this->conf['settings'] = $this->flexFormSettingsService->combineSettings(
            $this->conf['settings'] ?? [],
            $this->cObj->data['pi_flexform'] ?? '',
        );
    }
}
