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
        if (($identifier['type'] ?? '') === 'some_other_type') {
            $identifier['type'] = 'my_custom_type';
        }
        $event->setIdentifier($identifier);
    }
}
