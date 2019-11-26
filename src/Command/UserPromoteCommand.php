<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserPromoteCommand extends Command
{
    protected static $defaultName = 'app:user:promote';
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        parent::__construct(self::$defaultName);

        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a role to a user')
            ->addArgument('email', InputArgument::OPTIONAL, 'Email')
            ->addArgument('role', InputArgument::OPTIONAL, 'Role');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $role = $input->getArgument('role');

        $helper = $this->getHelper('question');

        if ( ! $email) {
            $question = new Question('Please enter an email address ');
            $email = $helper->ask($input, $output, $question);
        }

        $user = $this->userRepository->findOneBy(['email' => $email]);
        if (false === $user instanceof User) {
            $io->error('No user found');

            return 0;
        }

        if ( ! $role) {
            $question = new Question('Please enter a role ');
            $role = $helper->ask($input, $output, $question);
        }

        $violations = $this->validator->validate($role, [new NotBlank()]);
        if (0 !== $violations->count()) {
            foreach ($violations as $violation) {
                $io->error($violation->getMessage());
            }

            return 0;
        }

        $roles = $user->getRoles();
        if (in_array($role, $roles)) {
            $io->error('User already has role');

            return 0;
        }

        $roles[] = $role;
        $user->setRoles(array_unique($roles));

        $this->entityManager->flush();
        $io->success('User was promoted');

        return 0;
    }
}
