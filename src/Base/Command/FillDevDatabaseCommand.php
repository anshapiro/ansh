<?php

namespace Base\Command;

use Help\Api;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class FillDevDatabaseCommand extends Command
{
    private const AVAILABLE_ENVIRONMENTS = ['dev'];

    /** @var string */
    protected static $defaultName = 'base:fill-dev-database';

    /** @var string */
    private $env;

    /** @var OutputInterface */
    private $output;

    /** @var SymfonyStyle */
    private $io;

    /**
     * FillDevDatabaseCommand constructor.
     *
     * @param string $env
     */
    public function __construct(string $env)
    {
        $this->env = $env;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Filling dev database with fixtures');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->io = new SymfonyStyle($input, $this->output);

        if ($this->isEnvironmentAvailable()) {
            $this
                ->purgeDatabase()
                ->runMigrations()
                ->createAdminUser()
                ->loadFixtures();

            $this->io->success('Successfully finished!');
        }
    }

    /** @return bool */
    private function isEnvironmentAvailable(): bool
    {
        $isAvailable = \in_array($this->env, self::AVAILABLE_ENVIRONMENTS);

        if (!$isAvailable) {
            $this->io->warning(sprintf('Environment "%s" is not available for filling!', $this->env));
        }

        return $isAvailable;
    }

    /** @return FillDevDatabaseCommand */
    private function purgeDatabase(): self
    {
        $this->io->section('Purging dev database...');

        $command = $this->getApplication()->find('d:s:d');

        $greetInput = new ArrayInput([
            '--full-database' => true,
            '--force' => true,
        ]);
        $greetInput->setInteractive(false);
        $command->run($greetInput, $this->output);

        return $this;
    }

    /** @return FillDevDatabaseCommand */
    private function runMigrations(): self
    {
        $this->io->section('Executing migrations...');

        $command = $this->getApplication()->find('d:m:m');

        $greetInput = new ArrayInput([]);
        $greetInput->setInteractive(false);
        $command->run($greetInput, $this->output);

        $this->io->success('All migrations have been successfully executed!');

        return $this;
    }

    private function createAdminUser(): self
    {
        $this->io->section('Creating admin user...');

        $command = $this->getApplication()->find('base:create-admin-user');

        $greetInput = new ArrayInput([
            'command' => 'base:create-admin-user',
            '--show-messages' => false,
        ]);
        $greetInput->setInteractive(false);
        $command->run($greetInput, $this->output);

        $this->io->success('Admin user has been successfully created!');

        return $this;
    }

    /** @return FillDevDatabaseCommand */
    private function loadFixtures(): self
    {
        $this->io->section('Loading fixtures...');

        $command = $this->getApplication()->find('d:f:l');

        $greetInput = new ArrayInput(['--append' => true]);
        $greetInput->setInteractive(false);
        $command->run($greetInput, $this->output);

        $this->io->success('All fixtures have been successfully loaded!');

        return $this;
    }
}
