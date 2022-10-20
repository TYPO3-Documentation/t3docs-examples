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

namespace T3docs\Examples\Service;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

class StandaloneViewService
{
    public function createView(ServerRequestInterface $request, array $config, string $templateName, string $format = 'html'): StandaloneView
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setRequest($request);
        $view->setLayoutRootPaths([
            GeneralUtility::getFileAbsFileName($config['view']['layoutRootPath'] ?? 'EXT:examples/Resources/Private/Layouts'),
        ]);
        $view->setPartialRootPaths([
            GeneralUtility::getFileAbsFileName($config['view']['partialRootPath'] ?? 'EXT:examples/Resources/Private/Partials'),
        ]);
        $view->setTemplateRootPaths([
            GeneralUtility::getFileAbsFileName($config['view']['templateRootPath'] ?? 'EXT:examples/Resources/Private/Templates'),
        ]);
        $view->setFormat($format);
        $view->setTemplate($templateName);
        $view->assignMultiple([
            'settings' => $config['settings'] ?? [],
        ]);
        return $view;
    }
}
