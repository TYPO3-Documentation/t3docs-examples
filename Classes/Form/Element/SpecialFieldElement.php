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

namespace T3docs\Examples\Form\Element;

use TYPO3\CMS\Backend\Form\Behavior\UpdateValueOnFieldChange;
use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

class SpecialFieldElement extends AbstractFormElement
{
    public function render(): array
    {
        $row = $this->data['databaseRow'];
        $parameterArray = $this->data['parameterArray'];
        $color = $parameterArray['fieldConf']['config']['parameters']['color'];
        $size = $parameterArray['fieldConf']['config']['parameters']['size'];

        $fieldInformationResult = $this->renderFieldInformation();
        $fieldInformationHtml = $fieldInformationResult['html'];
        $resultArray = $this->mergeChildReturnIntoExistingResult($this->initializeResultArray(), $fieldInformationResult, false);

        $fieldId = StringUtility::getUniqueId('formengine-textarea-');

        $attributes = [
            'id' => $fieldId,
            'name' => htmlspecialchars((string)$parameterArray['itemFormElName']),
            'size' => $size,
            'data-formengine-input-name' => htmlspecialchars((string)$parameterArray['itemFormElName']),
        ];
        if ($parameterArray['fieldChangeFunc'] instanceof UpdateValueOnFieldChange) {
            $attributes['onChange'] = $parameterArray['fieldChangeFunc'];
        }

        $attributes['placeholder'] = 'Enter special value for user "' . htmlspecialchars(trim((string)$row['username'])) .
            '" in size ' . $size;
        $classes = [
            'form-control',
            't3js-formengine-textarea',
            'formengine-textarea',
        ];
        $itemValue = $parameterArray['itemFormElValue'];
        $attributes['class'] = implode(' ', $classes);

        $html = [];
        $html[] = '<div class="formengine-field-item t3js-formengine-field-item" style="padding: 5px; background-color: ' . $color . ';">';
        $html[] = $fieldInformationHtml;
        $html[] = '<div class="form-wizards-wrap">';
        $html[] = '<div class="form-wizards-element">';
        $html[] = '<div class="form-control-wrap">';
        $html[] = '<input type="text" value="' . htmlspecialchars((string)$itemValue, ENT_QUOTES) . '" ';
        $html[] = GeneralUtility::implodeAttributes($attributes, true);
        $html[] = ' />';
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '</div>';
        $resultArray['html'] = implode(LF, $html);
        return $resultArray;
    }
}
