<?php

namespace App\Service;

use App\Entity\Activation;
use App\Entity\User;
use App\Exception\MissingAccountActivationException;
use App\Mail\OhanoMail;
use App\Mail\OhanoMailer;
use App\Ohano;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class UserService
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly ManagerRegistry $doctrine,
        private readonly MiscService $miscService,
        private readonly Environment $twig,
        private readonly TranslatorInterface $translator,
        private readonly ActivationService $activationService,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function createUserFromRequest(Request $request, bool $isModerator = false, bool $isAdmin = false): ?User
    {
        $data = $request->toArray();
        return $this->createUser($data['username'], $data['password'], $data['email'], $isModerator, $isAdmin);
    }

    /**
     * @throws Exception
     */
    public function createUser(string $username, string $email, string $password, bool $isModerator = false, bool $isAdmin = false): ?User
    {
        $roles = ['ROLE_USER'];
        if ($isModerator) {
            $roles = ['ROLE_MODERATOR'];
        }
        if ($isAdmin) {
            $roles = ['ROLE_ADMIN'];
        }

        $user = new User();
        $user->setEmail($email);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);
        $user->setUsername($username);
        $user->setRoles($roles);
        $user->setBits(Ohano::STARTING_BITS);
        $user->setActive(false);
        $user->setVerified(false);
        $user->setCreated(new DateTime());
        $user->setUpdated(new DateTime());
        $this->doctrine->getManager()->persist($user);

        $this->doctrine->getManager()->flush();
        $this->activationService->createActivationForUser($user);

        $this->miscService->createMissingEntities($user);

        return $user;
    }
}