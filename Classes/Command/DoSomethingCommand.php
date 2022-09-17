<?php

declare(strict_types=1);

namespace T3docs\Examples\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DoSomethingCommand extends Command
{
    protected function configure(): void
    {
        $this->setDescription('A Command that does nothing and always fails');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Do awesome stuff
        return Command::SUCCESS;
    }
}
