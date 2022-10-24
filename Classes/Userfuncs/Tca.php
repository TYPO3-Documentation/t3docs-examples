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

namespace T3docs\Examples\Userfuncs;

use TYPO3\CMS\Backend\Form\Element\UserElement;
use TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * Class that implements many examples related to TCA or TCEform manipulations
 *
 * @author Francois Suter <francois.suter@typo3.org>
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
        $color = $configuration['parameters']['color'] ?? 'red';
        $size = (isset($configuration['parameters']['size'])) ? (int)$configuration['parameters']['size'] : 20;
        $formField = '<div style="padding: 5px; background-color: ' . $color . ';">';
        $formField .= '<input type="text" name="' . $configuration['itemFormElName'] . '"';
        $formField .= ' value="' . htmlspecialchars((string)$configuration['itemFormElValue']) . '"';
        $formField .= ' size="' . $size . '"';
        $formField .= ' onchange="' . htmlspecialchars(implode('', $configuration['fieldChangeFunc'])) . '"';
        $formField .= $configuration['onFocus'];
        $formField .= ' /></div>';
        return $formField;
    }

    /**
     * Creates custom titles for the records of the tx_examples_haiku table.
     *
     * @param array $parameters Parameters used to identify the current record
     * @param object $parentObject Calling object (null in this case)
     */
    public function haikuTitle(&$parameters, $parentObject)
    {
        $record = BackendUtility::getRecord($parameters['table'], $parameters['row']['uid'] ?? 0);
        if ($record === null) {
            return;
        }
        $newTitle = $record['title'] ?? '';
        $newTitle .= ' (' . substr(strip_tags($record['poem'] ?? ''), 0, 10) . '...)';
        $parameters['title'] = $newTitle;
    }
}
