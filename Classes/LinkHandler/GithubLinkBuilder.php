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

namespace T3docs\Examples\LinkHandler;

use TYPO3\CMS\Frontend\Typolink\AbstractTypolinkBuilder;
use TYPO3\CMS\Frontend\Typolink\LinkResult;
use TYPO3\CMS\Frontend\Typolink\LinkResultInterface;
use TYPO3\CMS\Frontend\Typolink\UnableToLinkException;

/**
 * Builds a TypoLink to a Github issue
 */
class GithubLinkBuilder extends AbstractTypolinkBuilder
{
    private const TYPE_GITHUB = 'github';

    public function build(
        array &$linkDetails,
        string $linkText,
        string $target,
        array $conf,
    ): LinkResultInterface {
        $issueId = (int)$linkDetails['issue'];
        if ($issueId < 1) {
            throw new UnableToLinkException(
                '"' . $issueId . '" is not a valid GitHub issue number.',
                // Use the Unix timestamp of the time of creation of this message
                1665304602,
                null,
                $linkText,
            );
        }
        $url = 'https://github.com/TYPO3-Documentation/TYPO3CMS-Reference-CoreApi/issues/' . $issueId;

        return (new LinkResult(self::TYPE_GITHUB, $url))
            ->withTarget($target)
            ->withLinkConfiguration($conf)
            ->withLinkText($linkText);
    }
}
