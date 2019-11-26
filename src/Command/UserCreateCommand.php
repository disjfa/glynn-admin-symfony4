<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserCreateCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:user:create';
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        parent::__construct(self::$defaultName);

        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    protected function configure()
    {
        $this
            ->setDescription('Create a new user')
            ->addArgument('email', InputArgument::OPTIONAL, 'Email')
            ->addArgument('password', InputArgument::OPTIONAL, 'Password');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $helper = $this->getHelper('question');

        if ( ! $email) {
            $question = new Question('Please enter an email address ');
            $email = $helper->ask($input, $output, $question);
        }

        $violations = $this->validator->validate($email, [new Email(), new NotBlank()]);
        if (0 !== $violations->count()) {
            foreach ($violations as $violation) {
                $io->error($violation->getMessage());
            }

            return 0;
        }

        if ( ! $password) {
            $question = new Question('Please enter a password ');
            $password = $helper->ask($input, $output, $question);
        }

        $violations = $this->validator->validate($password, [new NotBlank()]);
        if (0 !== $violations->count()) {
            foreach ($violations as $violation) {
                $io->error($violation->getMessage());
            }

            return 0;
        }

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, $password));

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (UniqueConstraintViolationException $e) {
            $io->error($e->getMessage());

            return 0;
        }

        $io->success('User was created');

        return 0;
    }
}
