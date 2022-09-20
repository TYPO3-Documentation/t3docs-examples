<?php

namespace T3docs\Examples\Controller;

use T3docs\Examples\Domain\Repository\HaikuRepository;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Class FalExampleController
 */
class HaikuController {

    /**
     * The back-reference to the mother cObj object set at call time
     */
    public ContentObjectRenderer $cObj;
    public array $conf = [];
    public StandaloneView $view;

    public function __construct(
        protected readonly HaikuRepository $haikuRepository,
    ) {
    }

    /**
     * This setter is called when the plugin is called from UserContentObject (USER)
     * via ContentObjectRenderer->callUserFunction().
     */
    public function setContentObjectRenderer(ContentObjectRenderer $cObj): void
    {
        $this->cObj = $cObj;
    }

    public function main(string $content, array $conf) : string
    {
        $this->conf = $conf;
        $this->loadFlexFormSettings();
        $this->initView();

        $action = $_REQUEST['tx_examples_haiku']['action'] ?? 'list';
        switch ($action) {
            case 'show':
                return $this->showAction((int) $_REQUEST['tx_examples_haiku']['haiku'] ?? 0);
            case 'findByTitle':
                return $this->findByTitleAction($_REQUEST['tx_examples_haiku']['haiku_title'] ?? '');
            case 'list':
                return $this->listAction();
            default:
                return $this->errorAction();
        }

    }

    private function initView(): void
    {
        $this->view = GeneralUtility::makeInstance(StandaloneView::class);
        $this->view->setLayoutRootPaths([
            GeneralUtility::getFileAbsFileName('EXT:examples/Resources/Private/Layouts'),
        ]);
        $this->view->setPartialRootPaths([
            GeneralUtility::getFileAbsFileName('EXT:examples/Resources/Private/Partials'),
        ]);
        $this->view->setTemplateRootPaths([
            GeneralUtility::getFileAbsFileName('EXT:examples/Resources/Private/Templates'),
        ]);
        $this->view->setFormat('html');
        $this->view->setTemplate('Haiku/Default');
        $this->view->assignMultiple([
            'settings' => $this->conf['settings'] ?? [],
        ]);
    }

    private function showAction(int $haiku) : string
    {
        $this->view->assignMultiple([
            'haiku' => $this->haikuRepository->findByUid($haiku),
        ]);
        $this->view->setTemplate('Haiku/Show');
        return $this->view->render();
    }

    private function listAction() : string
    {
        $this->view->assignMultiple([
            'haikus' => $this->haikuRepository->findAll(),
        ]);
        $this->view->setTemplate('Haiku/List');
        return $this->view->render();
    }

    private function errorAction() :string
    {
        return $this->listAction();
    }

    private function findByTitleAction(string $haikuTitle) : string
    {
        $this->view->assignMultiple([
            'haiku' => $this->haikuRepository->findByTitle($haikuTitle),
        ]);
        $this->view->setTemplate('Haiku/Show');
        return $this->view->render();
    }

    private function loadFlexFormSettings(): void
    {
        if (!is_string($this->cObj->data['pi_flexform'])) {
            return;
        }
        $flexFormData = GeneralUtility::makeInstance(FlexFormService::class)
            ->convertFlexFormContentToArray($this->cObj->data['pi_flexform']);
        $this->cObj->data['pi_flexform'] = $flexFormData;
        if (is_array($flexFormData['settings'])) {
            foreach ($flexFormData['settings'] as $key => $flexFormValue) {
                if ($flexFormValue) {
                    $this->conf['settings'][$key] = (string)$flexFormValue;
                }
            }
        }
    }
}
