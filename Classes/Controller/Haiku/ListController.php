<?php

namespace T3docs\Examples\Controller\Haiku;

use Psr\Http\Message\ServerRequestInterface;
use T3docs\Examples\Domain\Repository\HaikuRepository;
use T3docs\Examples\Service\FlexFormSettingsService;
use T3docs\Examples\Service\StandaloneViewService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class ListController
{
    /**
     * The back-reference to the mother cObj object set at call time
     */
    public ContentObjectRenderer $cObj;
    public array $conf = [];

    public function __construct(
        private readonly HaikuRepository $haikuRepository,
        private readonly FlexFormSettingsService $flexFormSettingsService,
        private readonly StandaloneViewService $viewService,
    ) {
    }

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
            $this->cObj->data['pi_flexform'] ?? ''
        );
    }
}
