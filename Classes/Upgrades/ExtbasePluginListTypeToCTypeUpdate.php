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

namespace T3docs\Examples\Upgrades;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\AbstractListTypeToCTypeUpdate;

#[UpgradeWizard('example_extbasePluginListTypeToCTypeUpdate')]
final class ExtbasePluginListTypeToCTypeUpdate extends AbstractListTypeToCTypeUpdate
{
    protected function getListTypeToCTypeMapping(): array
    {
        return [
            'examples_error' => 'examples_error',
            'examples_htmlparser' => 'examples_htmlparser',
            'examples_falexamples' => 'examples_falexamples',
        ];
    }

    public function getTitle(): string
    {
        return 'Migrate Example Extbase plugins';
    }

    public function getDescription(): string
    {
        return 'Migrate Example Extbase plugins from deprecated registration via "list-type" to "CType"';
    }
}