<?php

namespace T3docs\Examples\Controller;

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

use TYPO3\CMS\Backend\Form\Element\InputTextElement;
use TYPO3\CMS\Core\Page\PageRenderer;

/**
 * Wizard for display +/- controls next to an input field.
 *
 * @author Francois Suter <francois.suter@typo3.org>
 */
class PlusMinusWizardController
{
    protected PageRenderer $pageRenderer;

    public function injectPageRenderer(PageRenderer $pageRenderer)
    {
        $this->pageRenderer = $pageRenderer;
    }

    /**
     * Renders the wizard itself.
     *
     * @param array $fieldParameters Parameters of the field
     * @param InputTextElement $textField Calling object
     * @return string HTML for the wizard
     */
    public function render($fieldParameters, InputTextElement $textField)
    {
        // Load the related JavaScript module
        $this->pageRenderer->loadRequireJsModule(
            'TYPO3/CMS/Examples/PlusMinusWizard'
        );
        // Render the two buttons
        $wizard = '<button class="btn btn-default tx_examples_weirdness" data-item="' .
            $fieldParameters['itemName'] .
            '" data-action="minus"><span class="t3-icon fa fa-minus"></span></button>';
        $wizard .= '<button class="btn btn-default tx_examples_weirdness" data-item="' .
            $fieldParameters['itemName'] .
            '" data-action="plus"><span class="t3-icon fa fa-plus"></span></button>';
        return $wizard;
    }
}
