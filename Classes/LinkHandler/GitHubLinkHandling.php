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

use TYPO3\CMS\Core\LinkHandling\LinkHandlingInterface;

/**
 * Resolves GitHub Links
 */
class GitHubLinkHandling implements LinkHandlingInterface
{
    /**
     * The Base URN for this link handling to act on
     * @var string
     */
    protected $baseUrn = 't3://github';

    /**
     * Returns a string interpretation of the link href query from objects,
     * something like
     *
     *  - t3://page?uid=23&my=value#cool
     *  - https://www.typo3.org/
     *  - t3://file?uid=13
     *  - t3://folder?storage=2&identifier=/my/folder/
     *  - mailto:mac@safe.com
     *
     * array of data -> string
     */
    public function asString(array $parameters): string
    {
        $githubIssue = (int)$parameters['issue'];
        return $this->baseUrn . '?issue=' . $githubIssue;
    }

    /**
     * Returns an array with data interpretation of the link href from parsed query parameters of urn
     * representation.
     *
     * array of strings -> array of data
     */
    public function resolveHandlerData(array $data): array
    {
        return [
            'issue' => (int)$data['issue'],
        ];
    }
}
