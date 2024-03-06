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

namespace T3docs\Examples\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DoSomethingCommand extends Command
{
    protected function configure(): void
    {
        $this->setHelp('This command does nothing. It always succeeds.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Do awesome stuff
        return Command::SUCCESS;
    }
}
