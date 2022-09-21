<?php

namespace T3docs\Examples\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

class StandaloneViewService
{
    public function createView(array $config, string $templateName, string $format = 'html'): StandaloneView
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setLayoutRootPaths([
            GeneralUtility::getFileAbsFileName($config['view']['layoutRootPath']?? 'EXT:examples/Resources/Private/Layouts'),
        ]);
        $view->setPartialRootPaths([
            GeneralUtility::getFileAbsFileName($config['view']['partialRootPath']?? 'EXT:examples/Resources/Private/Partials'),
        ]);
        $view->setTemplateRootPaths([
            GeneralUtility::getFileAbsFileName($config['view']['templateRootPath']?? 'EXT:examples/Resources/Private/Templates'),
        ]);
        $view->setFormat($format);
        $view->setTemplate($templateName);
        $view->assignMultiple([
            'settings' => $config['settings'] ?? [],
        ]);
        return $view;
    }
}
