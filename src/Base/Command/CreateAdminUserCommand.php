<?php

namespace Base\Command;

use App\User\Action\User\UserActionInterface;
use App\User\Model\User\UserRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\User\Model\Permission\PermissionInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateAdminUserCommand extends Command
{
    private const DEFAULT_ADMIN_USERNNAME = 'admin';

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

    /** @var bool */
    private $showMessages = true;

    /** @var array */
    private $adminData = [];

    /**
     * CreateAdminUserCommand constructor.
     *
     * @param UserActionInterface $action
     * @param ObjectManager $om
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserActionInterface $action, ObjectManager $om, UserRepositoryInterface $userRepository)
    {
        $this->createUserAction = $action;
        $this->om = $om;
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Create admin user')
            ->addArgument('email', InputArgument::REQUIRED,'User email')
            ->addArgument('password', InputArgument::REQUIRED,'User password')
            ->addArgument('surname', InputArgument::REQUIRED,'User surname')
            ->addArgument('name', InputArgument::REQUIRED,'User name')
            ->addArgument('patronymic', InputArgument::OPTIONAL,'User patronymic')
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
            $this
                ->processArguments($input)
                ->createUser();

            $this->message('Successfully finished!', self::SUCCESS_MESSAGE_TYPE);
        }

        $this->resetClassVariables();
    }

    /** @return bool */
    private function isUnique(): bool
    {
        $isUnique = $this->userRepository->findOneBy(['username' => self::DEFAULT_ADMIN_USERNNAME]) === null;

        if ($isUnique === false) {
            $this->message(
                sprintf('Admin with username "%s" already exists!', self::DEFAULT_ADMIN_USERNNAME),
                self::NOTE_MESSAGE_TYPE
            );
        }

        return $isUnique;
    }

    /**
     * @param InputInterface $input
     *
     * @return CreateAdminUserCommand
     */
    private function processArguments(InputInterface $input): self
    {
        $this->message('Processing input arguments...', self::SECTION_MESSAGE_TYPE);

        $this->adminData = $input->getArguments();
        $this->adminData['username'] = self::DEFAULT_ADMIN_USERNNAME;
        $this->adminData['permissions'] = PermissionInterface::PERMISSIONS;

        foreach (['name', 'surname', 'patronymic'] as $argumentName) {
            if (\array_key_exists($argumentName, $this->adminData)) {
                $this->adminData['fullName'][$argumentName] = $this->adminData[$argumentName];
                unset($this->adminData[$argumentName]);
            }
        }

        $this->message('Input arguments have been successfully processed!', self::SUCCESS_MESSAGE_TYPE);

        return $this;
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
        $this->adminData = [];
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
