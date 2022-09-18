<?php

declare(strict_types=1);

namespace T3docs\Examples\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use T3docs\Examples\Exception\InvalidWizardException;

class CreateWizardCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setHelp('This command accepts arguments')
            ->addArgument(
                'wizardName',
                InputArgument::OPTIONAL,
                'The wizard\'s name'
            )
            ->addOption(
                'brute-force',
                'b',
                InputOption::VALUE_NONE,
                'Allow the "Wizard of Oz". You can use --brute-force or -b when running command'
            );
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $io = new SymfonyStyle($input, $output);
        $wizardName = $input->getArgument('wizardName');
        $bruteForce = (bool)$input->getOption('brute-force');
        try {
            $this->doMagic($io, $wizardName, $bruteForce);
        } catch (InvalidWizardException $exception) {
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }

    private function doMagic(
        SymfonyStyle $io,
        mixed &$wizardName,
        bool $bruteForce
    ) {
        $io->comment('Trying to create wizard ' . $wizardName . '...');
        if (!$bruteForce) {
            if ($wizardName === 'Oz') {
                $io->error('The Wizard of Oz is not allowed. Use --brute-force to allow it.');
                throw new InvalidWizardException();
            }
        }
        if ($wizardName === null) {
            $wizardName = (string)$io->ask(
                'Enter the wizard\'s name (e.g. "Gandalf the Grey")',
                'Lord Voldermort'
            );
        }
        $io->success('The wizard ' . $wizardName . ' was created');
    }
}
