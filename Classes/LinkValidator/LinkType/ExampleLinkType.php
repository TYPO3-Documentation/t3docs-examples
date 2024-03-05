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

namespace T3docs\Examples\LinkValidator\LinkType;

use TYPO3\CMS\Linkvalidator\Linktype\AbstractLinktype;

/**
 * This class provides Check Example Links plugin implementation
 */
class ExampleLinkType extends AbstractLinktype
{
    protected string $identifier = 'example';

    public function checkLink($url, $softRefEntry, $reference): bool
    {
        $isValidUrl = false;
        // TODO: Implement checkLink() method.
        return $isValidUrl;
    }

    public function getErrorMessage($errorParams): string
    {
        $lang = $this->getLanguageService();
        return match ($errorParams['errno'] ?? 0) {
            404 => $lang->sL('LLL:EXT:linkvalidator/Resources/Private/Language/Module/locallang.xlf:list.report.pagenotfound404'),
            // fall back to generic error message
            default => sprintf(
                $lang->sL('LLL:EXT:linkvalidator/Resources/Private/Language/Module/locallang.xlf:list.report.externalerror'),
                $errorParams['errno'],
            ),
        };
    }
}
