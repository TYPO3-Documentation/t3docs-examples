<?php

namespace T3docs\Examples\LinkHandler;

/**
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

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\View\BackendViewFactory;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Backend\Controller\AbstractLinkBrowserController;
use TYPO3\CMS\Backend\LinkHandler\LinkHandlerInterface;
use TYPO3Fluid\Fluid\View\ViewInterface;

class GitHubLinkHandler implements LinkHandlerInterface
{
    /**
     * Available additional link attributes
     *
     * 'rel' only works in RTE, still we have to declare support for it.
     *
     * @var string[]
     */
    protected $linkAttributes = ['target', 'title', 'class', 'params', 'rel'];

    /**
     * Parts of the current link
     *
     * @var array
     */
    protected $linkParts = [];

    /**
     * @var AbstractLinkBrowserController
     */
    protected $linkBrowser;

    /**
     * @var IconFactory
     */
    protected $iconFactory;

    /**
     * @var ViewInterface
     */
    protected $view;

    /**
     * @var PageRenderer
     */
    protected $pageRenderer;

    /**
     * @var array $configuration
     */
    protected $configuration;

    /**
     * Constructor
     */
    public function __construct(
        protected readonly BackendViewFactory $backendViewFactory,
    ) {
        // remove unsupported link attribute
        unset($this->linkAttributes[array_search('params', $this->linkAttributes, true)]);
    }

    /**
     * Initialize the handler
     *
     * @param AbstractLinkBrowserController $linkBrowser
     * @param string $identifier
     * @param array $configuration Page TSconfig
     */
    public function initialize(AbstractLinkBrowserController $linkBrowser, $identifier, array $configuration)
    {
        $this->linkBrowser = $linkBrowser;
        $this->iconFactory = GeneralUtility::makeInstance(IconFactory::class);
        $this->pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $this->configuration = $configuration;
    }

    /**
     * Checks if this is the handler for the given link
     *
     * Also stores information locally about currently linked issue
     *
     * @param array $linkParts Link parts as returned from TypoLinkCodecService
     *
     * @return bool
     */
    public function canHandleLink(array $linkParts): bool
    {
        if (!isset($linkParts['type']) || $linkParts['type'] !== 'github') {
            return false;
        }
        $this->linkParts = $linkParts;
        return true;
    }

    /**
     * Format the current link for HTML output
     *
     * @return string
     */
    public function formatCurrentUrl(): string
    {
        return $this->linkParts['url']['url'];
    }

    /**
     * Render the link handler
     *
     * @param ServerRequestInterface $request
     *
     * @return string
     */
    public function render(ServerRequestInterface $request): string
    {
        $this->pageRenderer->loadJavaScriptModule('@t3docs/examples/github_link_handler.js');
        $view = $this->backendViewFactory->create($request, ['typo3/cms-backend', 'examples']);
        $view->assign('project', $this->configuration['project']);
        $view->assign('action', $this->configuration['action']);
        $view->assign('github', !empty($this->linkParts) ? $this->linkParts['url']['value'] : '');

        return $view->render('LinkBrowser/GitHub');
    }

    /**
     * @return string[] Array of body-tag attributes
     */
    public function getBodyTagAttributes(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getLinkAttributes()
    {
        return $this->linkAttributes;
    }

    /**
     * @param string[] $fieldDefinitions Array of link attribute field definitions
     * @return string[]
     */
    public function modifyLinkAttributes(array $fieldDefinitions)
    {
        return $fieldDefinitions;
    }

    /**
     * We don't support updates since there is no difference to simply set the link again.
     *
     * @return bool
     */
    public function isUpdateSupported()
    {
        return false;
    }
}
