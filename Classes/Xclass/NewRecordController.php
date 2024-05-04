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

namespace T3docs\Examples\Xclass;

/**
 * This class XCLASSes NewRecordController to modify the layout of the New Record Wizard
 *
 * @author Francois Suter <francois@typo3.org>
 *
 * @todo This example is broken and should be removed or fixed. Parent controller changes, most likely already for
 *       TYPO3 v12. Property `$this->content` does no longer exists, and therefore the example does not demonstrate
 *       anything working or useful - and will throw E_DEPRECATION with PHP 8.3 and corresponding error level.
 */
class NewRecordController extends \TYPO3\CMS\Backend\Controller\NewRecordController
{
    /**
     * Adds a section at the bottom of the New Record Wizard
     *
     * USAGE: Core APIs > TYPO3 API overview > PHP Class Extension > Which classes? > Example - Adding a small feature in the interface
     */
    protected function renderNewRecordControls(): void
    {
        parent::renderNewRecordControls();
        $label = $GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/locallang.xlf:help');
        $text = $GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/locallang.xlf:make_choice');
        $str = '<div><h2 class="uppercase" >' . htmlspecialchars((string)$label) . '</h2>' . $text . '</div>';

        $this->content .= $str;
    }
}
