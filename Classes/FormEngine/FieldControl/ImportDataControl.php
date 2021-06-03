<?php
declare(strict_types=1);

namespace T3docs\Examples\FormEngine\FieldControl;

use TYPO3\CMS\Backend\Form\AbstractNode;

class ImportDataControl extends AbstractNode
{
    public function render()
    {
        $result = [
            'iconIdentifier' => 'import-data',
            'title' => $GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:pages.importData'),
            'linkAttributes' => [
                'class' => 'importData ',
                'data-id' => $this->data['databaseRow']['somefield']
            ],
            'requireJsModules' => ['TYPO3/CMS/Examples/ImportData'],
        ];
        return $result;
    }
}
