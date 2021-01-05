<?php
declare(strict_types = 1);
namespace T3docs\Examples\Form\Element;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;

class SpecialFieldElement extends AbstractFormElement
{
    public function render()
    {
        // Custom TCA properties and other data can be found in $this->data, for example the above
        // parameters are available in $this->data['parameterArray']['fieldConf']['config']['parameters']
        $result = $this->initializeResultArray();
        $configuration = $this->data['parameters'];
        $color = (isset($configuration['parameters']['color'])) ? $configuration['parameters']['color'] : 'red';
        $size = (isset($configuration['parameters']['size'])) ? (int)$configuration['parameters']['size'] : 20;
        $formField = '<div style="padding: 5px; background-color: ' . $color . ';">';
        $formField .= '<input type="text" name="' . $configuration['itemFormElName'] . '"';
        $formField .= ' value="' . htmlspecialchars($configuration['itemFormElValue']) . '"';
        $formField .= ' size="' . $size . '"';
        $formField .= ' onchange="' . htmlspecialchars(implode('', $configuration['fieldChangeFunc'])) . '"';
        $formField .= $configuration['onFocus'];
        $formField .= ' /></div>';
        $result['html'] = $formField;
        return $result;
    }
}
