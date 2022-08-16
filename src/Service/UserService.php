<?php

namespace App\Service;

use App\Entity\BaseProfile;
use App\Entity\Profile;
use App\Entity\User;
use App\Entity\Verification;
use App\Ohano;
use App\Option\ProfileType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly ManagerRegistry $doctrine,
        private readonly MiscService $miscService
    )
    {
    }

    public function createUserFromRequest(Request $request, bool $isModerator = false, bool $isAdmin = false): ?User
    {
        $data = $request->toArray();
        return $this->createUser($data['username'], $data['password'], $data['email'], $isModerator, $isAdmin);
    }

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
        $user->setCreated(new \DateTime());
        $user->setUpdated(new \DateTime());
        $this->doctrine->getManager()->persist($user);

        $this->doctrine->getManager()->flush();

        $this->miscService->createMissingEntities($user);

        return $user;
    }
}