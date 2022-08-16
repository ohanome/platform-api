<?php

namespace App\Service;

use App\Entity\Profile;
use App\Entity\User;
use App\Entity\Verification;
use App\Option\ProfileType;
use App\Service\Validator\RequestValidator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher, private readonly ManagerRegistry $doctrine)
    {
    }

    public function createUserFromRequest(Request $request, bool $isModerator = false, bool $isAdmin = false): ?User
    {
        $data = $request->toArray();
        $roles = ['ROLE_USER'];
        if ($isModerator) {
            $roles = ['ROLE_MODERATOR'];
        }
        if ($isAdmin) {
            $roles = ['ROLE_ADMIN'];
        }

        $user = new User();
        $user->setEmail($data['email']);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);
        $user->setUsername($data['username']);
        $user->setRoles($roles);
        $user->setBits(10000);
        $user->setActive(false);
        $user->setVerified(false);
        $this->doctrine->getManager()->persist($user);

        $verification = new Verification();
        $verification->setUser($user);
        $this->doctrine->getManager()->persist($verification);

        $profile = new Profile();
        $profile->setUser($user);
        $profile->setName($user->getUsername());
        $profile->setType(ProfileType::Personal->value);

        $this->doctrine->getManager()->flush();
        return $user;
    }
}