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

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use T3docs\Examples\Http\MeowInformationRequester;

#[AsCommand(
    name: 'examples:meow',
    description: 'Meow Information',
)]
final class MeowInformationCommand extends Command
{
    public function __construct(
        private readonly MeowInformationRequester $requester,
        private readonly LoggerInterface $logger,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setHelp('Prints random information about cats retrieved from an API call');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output,
    ): int {
        $io = new SymfonyStyle($input, $output);
        $io->title($this->getDescription());

        try {
            $detail = $this->requester->request();
        } catch (\JsonException $e) {
            $this->logger->error($e->getMessage());
            $io->error('The service did not return a valid response. Try again later.');
            return Command::FAILURE;
        } catch (\Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        $io->writeln($detail);

        return Command::SUCCESS;
    }
}
