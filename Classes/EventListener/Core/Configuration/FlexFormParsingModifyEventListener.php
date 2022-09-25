<?php

declare(strict_types=1);

namespace T3docs\Examples\EventListener\Core\Configuration;

use TYPO3\CMS\Core\Configuration\Event\AfterFlexFormDataStructureIdentifierInitializedEvent;
use TYPO3\CMS\Core\Configuration\Event\AfterFlexFormDataStructureParsedEvent;
use TYPO3\CMS\Core\Configuration\Event\BeforeFlexFormDataStructureIdentifierInitializedEvent;
use TYPO3\CMS\Core\Configuration\Event\BeforeFlexFormDataStructureParsedEvent;

final class FlexFormParsingModifyEventListener
{
    public function setDataStructure(BeforeFlexFormDataStructureParsedEvent $event): void
    {
        $identifier = $event->getIdentifier();
        if (($identifier['type'] ?? '') === 'my_custom_type') {
            $event->setDataStructure('FILE:EXT:myext/Configuration/FlexForms/MyFlexform.xml');
        }
    }

    public function modifyDataStructure(AfterFlexFormDataStructureParsedEvent $event): void
    {
        $identifier = $event->getIdentifier();
        if (($identifier['type'] ?? '') === 'my_custom_type') {
            $parsedDataStructure = $event->getDataStructure();
            $parsedDataStructure['sheets']['sDEF']['ROOT']['TCEforms']['sheetTitle'] = 'Some dynamic custom sheet title';
            $event->setDataStructure($parsedDataStructure);
        }
    }

    public function setDataStructureIdentifier(BeforeFlexFormDataStructureIdentifierInitializedEvent $event): void
    {
        if ($event->getTableName() === 'tx_myext_sometable') {
            $event->setIdentifier([
                'type' => 'my_custom_type',
            ]);
        }
    }

    public function modifyDataStructureIdentifier(AfterFlexFormDataStructureIdentifierInitializedEvent $event): void
    {
        $identifier = $event->getIdentifier();
        if (($identifier['type'] ?? '') === 'mycustomtype') {
            $identifier['type'] = 'my_custom_type';
        }
        $event->setIdentifier($identifier);
    }
}
