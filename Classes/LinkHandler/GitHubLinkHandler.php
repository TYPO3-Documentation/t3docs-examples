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

namespace T3docs\Examples\LinkHandler;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Controller\AbstractLinkBrowserController;
use TYPO3\CMS\Backend\LinkHandler\LinkHandlerInterface;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\View\ViewInterface;

class GitHubLinkHandler implements LinkHandlerInterface
{
    /**
     * Available additional link attributes
     *
     * @var string[]
     */
    protected array $linkAttributes = ['target', 'title', 'class', 'params', 'rel'];

    protected array $linkParts = [];

    protected ViewInterface $view;

    protected array $configuration;

    public function __construct(
        // The page renderer is needed to register the JavaScript
        private readonly PageRenderer $pageRenderer,
    ) {}

    /**
     * Initialize the handler
     *
     * @param string $identifier Key of the current page TSconfig configuration
     * @param array $configuration Page TSconfig
     */
    public function initialize(AbstractLinkBrowserController $linkBrowser, $identifier, array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Checks if this is the handler for the given link
     *
     * Also stores information locally about currently linked issue
     *
     * @param array $linkParts Link parts as returned from TypoLinkCodecService
     */
    public function canHandleLink(array $linkParts): bool
    {
        if ($linkParts['type'] !== 'github') {
            return false;
        }
        $this->linkParts = $linkParts['url'] ?? [];
        return true;
    }

    /**
     * Format the current link for preview in the backend
     */
    public function formatCurrentUrl(): string
    {
        return 'https://github.com/' . $this->configuration['project'] . '/'
            . $this->configuration['action'] . '/' . $this->linkParts['issue'] ?? '';
    }

    /**
     * Render the link browser tab content
     */
    public function render(ServerRequestInterface $request): string
    {
        $this->pageRenderer->loadJavaScriptModule('@t3docs/examples/github_link_handler.js');
        $this->view->assign('project', $this->configuration['project']);
        $this->view->assign('action', $this->configuration['action']);
        $this->view->assign('linkParts', $this->linkParts);
        $this->view->assign('issue', $this->linkParts['issue'] ?? '');

        return $this->view->render('LinkBrowser/GitHub');
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

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }
}
