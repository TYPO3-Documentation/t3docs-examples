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

use TYPO3\CMS\Core\Service\FlexFormService;

class FlexFormSettingsService
{
    public function __construct(
        protected readonly FlexFormService $flexFormService,
    ) {}

    public function combineSettings(mixed $settings, string $flexFormString): array
    {
        // As the data from the TypoScript is user input you cannot be sure about types
        if (!is_array($settings ?? false)) {
            $settings = [];
        }
        $flexForm = $this->flexFormService->convertFlexFormContentToArray($flexFormString);
        // As the data from the FlexForm is user input you cannot be sure about types
        if (!is_array($flexForm['settings'] ?? false)) {
            $flexForm['settings'] = [];
        }
        foreach ($flexForm['settings'] as $key => $flexFormValue) {
            if ($flexFormValue) {
                $settings[$key] = $flexFormValue;
            }
        }
        return $settings;
    }
}
