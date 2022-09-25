<?php

namespace T3docs\Examples\Service;

use TYPO3\CMS\Core\Service\FlexFormService;

class FlexFormSettingsService
{
    public function __construct(
        protected readonly FlexFormService $flexFormService,
    ) {
    }

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
