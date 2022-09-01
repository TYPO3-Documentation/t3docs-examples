<?php

declare(strict_types=1);

namespace T3docs\Examples\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use T3docs\Examples\Http\MeowInformationRequester;

final class MeowInformationCommand extends Command
{
    public function __construct(
        private readonly MeowInformationRequester $requester,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setHelp('Prints out a random information about cats retrieved from an API call');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title($this->getDescription());

        try {
            $detail = $this->requester->request();
        } catch (\Exception $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        $io->writeln($detail);

        return Command::SUCCESS;
    }
}
