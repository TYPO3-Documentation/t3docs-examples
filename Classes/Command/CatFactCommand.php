<?php

declare(strict_types=1);

namespace T3docs\Examples\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use T3docs\Examples\Http\CatFactRequester;

final class CatFactCommand extends Command
{
    public function __construct(
        private readonly CatFactRequester $catFactRequester,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setHelp('Prints out a random fact about cats retrieved from an API call');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title($this->getDescription());

        try {
            $fact = $this->catFactRequester->request();
        } catch (\Exception $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        $io->writeln($fact);

        return Command::SUCCESS;
    }
}
