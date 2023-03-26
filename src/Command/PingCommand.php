<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

#[AsCommand('app:ping')]
class PingCommand extends Command
{
    public function __construct(
        private readonly HubInterface $hub,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $update = new Update('https://example.com/my-private-topic', json_encode(['random' => rand(1, 100)]));
        $this->hub->publish($update);

        (new SymfonyStyle($input, $output))->success('done');

        return Command::SUCCESS;
    }
}
