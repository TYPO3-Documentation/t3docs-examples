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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use T3docs\Examples\Exception\InvalidWizardException;

final class CreateWizardCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setHelp('This command accepts arguments')
            ->addArgument(
                'wizardName',
                InputArgument::OPTIONAL,
                'The wizard\'s name',
            )
            ->addOption(
                'brute-force',
                'b',
                InputOption::VALUE_NONE,
                'Allow the "Wizard of Oz". You can use --brute-force or -b when running command',
            );
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output,
    ): int {
        $io = new SymfonyStyle($input, $output);
        $wizardName = $input->getArgument('wizardName');
        $bruteForce = (bool)$input->getOption('brute-force');
        try {
            $this->doMagic($io, $wizardName, $bruteForce);
        } catch (InvalidWizardException) {
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }

    private function doMagic(
        SymfonyStyle $io,
        mixed $wizardName,
        bool $bruteForce,
    ) {
        $io->comment('Trying to create wizard ' . $wizardName . '...');
        if ($wizardName === null) {
            $wizardName = (string)$io->ask(
                'Enter the wizard\'s name (e.g. "Gandalf the Grey")',
                'Lord Voldermort',
            );
        }
        if (!$bruteForce && $wizardName === 'Oz') {
            $io->error('The Wizard of Oz is not allowed. Use --brute-force to allow it.');
            throw new InvalidWizardException();
        }
        $io->success('The wizard ' . $wizardName . ' was created');
    }
}
