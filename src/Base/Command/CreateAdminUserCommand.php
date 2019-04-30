<?php

namespace Base\Command;

use App\User\Action\User\UserActionInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use App\User\Model\User\UserRepositoryInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateAdminUserCommand extends Command
{
    private const SUCCESS_MESSAGE_TYPE = 'success';
    private const SECTION_MESSAGE_TYPE = 'section';
    private const NOTE_MESSAGE_TYPE = 'note';

    /** @var string */
    protected static $defaultName = 'base:create-admin-user';

    /** @var UserActionInterface */
    private $createUserAction;

    /** @var ObjectManager */
    private $om;

    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var InputInterface */
    private $input;

    /** @var SymfonyStyle */
    private $io;

    /** @var array */
    private $adminData;

    /** @var bool */
    private $showMessages = true;

    /**
     * CreateAdminUserCommand constructor.
     *
     * @param string $adminUsername
     * @param string $adminEmail
     * @param string $adminPassword
     * @param string $adminSurname
     * @param string $adminName
     * @param string|null $adminPatronymic
     * @param UserActionInterface $action
     * @param ObjectManager $om
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        string $adminUsername,
        string $adminEmail,
        string $adminPassword,
        string $adminSurname,
        string $adminName,
        ?string $adminPatronymic,
        UserActionInterface $action,
        ObjectManager $om,
        UserRepositoryInterface $userRepository
    ) {
        $this->adminData = [
            'username' => $adminUsername,
            'email' => $adminEmail,
            'password' => $adminPassword,
            'fullName' => [
                'surname' => $adminSurname,
                'name' => $adminName,
                'patronymic' => $adminPatronymic,
            ],
        ];

        $this->createUserAction = $action;
        $this->om = $om;
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Create admin user')
            ->addOption(
                'show-messages',
                'sm',
                InputOption::VALUE_OPTIONAL,
                'Enable or disable output messages',
                true
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->showMessages = (bool) $input->getOption('show-messages');


        if ($this->isUnique()) {
            $this->createUser();
        }

        $this->resetClassVariables();
    }

    /** @return bool */
    private function isUnique(): bool
    {
        $isUnique = $this->userRepository->findOneBy(['username' => $this->adminData['username']]) === null;

        if ($isUnique === false) {
            $this->message(
                sprintf('Admin with username "%s" already exists!', $this->adminData['username']),
                self::NOTE_MESSAGE_TYPE
            );
        }

        return $isUnique;
    }

    /** @return CreateAdminUserCommand */
    private function createUser(): self
    {
        $this->message('Creating user...', self::SECTION_MESSAGE_TYPE);

        $this->createUserAction->perform($this->adminData);
        $this->om->flush();

        $this->message('Admin user has been successfully created!', self::SUCCESS_MESSAGE_TYPE);

        return $this;
    }

    private function resetClassVariables(): void
    {
        $this->showMessages = true;
    }

    /**
     * @param string $message
     * @param string $type
     */
    private function message(string $message, string $type): void
    {
        if ($this->showMessages === true) {
            $this->io->$type($message);
        }
    }
}
