<?php
namespace Documentation\Examples\Userfuncs;

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

use TYPO3\CMS\Backend\Form\Element\UserElement;

/**
 * Class that implements many examples related to TCA or TCEform manipulations
 *
 * @author Francois Suter <francois.suter@typo3.org>
 * @package TYPO3
 * @subpackage tx_examples
 */
class Tca
{

    /**
     * Renders a custom, user-defined field.
     *
     * @param array $configuration
     * @param UserElement $parentObject
     * @return string HTML for the field
     */
    public function specialField($configuration, $parentObject)
    {
        $color = (isset($configuration['parameters']['color'])) ? $configuration['parameters']['color'] : 'red';
        $size = (isset($configuration['parameters']['size'])) ? (int)$configuration['parameters']['size'] : 20;
        $formField = '<div style="padding: 5px; background-color: ' . $color . ';">';
        $formField .= '<input type="text" name="' . $configuration['itemFormElName'] . '"';
        $formField .= ' value="' . htmlspecialchars($configuration['itemFormElValue']) . '"';
        $formField .= ' size="' . $size . '"';
        $formField .= ' onchange="' . htmlspecialchars(implode('', $configuration['fieldChangeFunc'])) . '"';
        $formField .= $configuration['onFocus'];
        $formField .= ' /></div>';
        return $formField;
    }

    /**
     * Renders a wizard providing JavaScript +/- controls
     * to increase or decrease an integer value in a field.
     *
     * @param    array $PA : parameters of the field
     * @param    object $fObj : calling object (TCEform)
     * @return    string    HTML for the wizard
     */
    public function someWizard($PA, $fObj)
    {
        // Note that the information is passed by reference,
        // so it's possible to manipulate the field directly
        // Here we highlight the field with the color passed as parameter
        $backgroundColor = 'white';
        if (!empty($PA['params']['color'])) {
            $backgroundColor = $PA['params']['color'];
        }
        $PA['item'] = '<div style="background-color: ' . $backgroundColor . '; padding: 4px;">' . $PA['item'] . '</div>';

        // Assemble the wizard itself
        $output = '<div style="margin-top: 8px; margin-left: 4px;">';

        $commonJavascriptCalls = $PA['fieldChangeFunc']['TBE_EDITOR_fieldChanged'] . $PA['fieldChangeFunc']['typo3form.fieldGet'] . ' return false;';
        // Create the + button
        $onClick = "document." . $PA['formName'] . "['" . $PA['itemName'] . "'].value++; " . $commonJavascriptCalls;
        $output .= '<a href="#" onclick="' . htmlspecialchars($onClick) . '" style="padding: 6px; border: 1px solid black; background-color: #999">+</a>';
        // Create the - button
        $onClick = "document." . $PA['formName'] . "['" . $PA['itemName'] . "'].value--; " . $commonJavascriptCalls;
        $output .= '<a href="#" onclick="' . htmlspecialchars($onClick) . '" style="padding: 6px; border: 1px solid black; background-color: #999">-</a>';
        $output .= '</div>';
        return $output;
    }

    /**
     * Creates custom titles for the records of the tx_examples_haiku table
     *
     * @param array $parameters Parameters used to identify the current record
     * @param object $parentObject Calling object
     * @return void
     */
    public function haikuTitle(&$parameters, $parentObject)
    {
        $record = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord($parameters['table'], $parameters['row']['uid']);
        $newTitle = $record['title'];
        $newTitle .= ' (' . substr(strip_tags($record['poem']), 0, 10) . '...)';
        $parameters['title'] = $newTitle;
    }
}
