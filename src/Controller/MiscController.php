<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/misc", name: 'app_misc_')]
class MiscController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MiscController.php',
        ]);
    }

    #[Route('/create-admin-user', name: 'create_admin_user', methods: ['GET'])]
    public function createAdminUser(ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $userExists = !empty($doctrine->getRepository(User::class)->findOneBy(['username' => 'admin']));

        if ($userExists) {
            return $this->json([
                'message' => 'Admin user already exists',
            ]);
        }
        $user = new User();
        $user->setUsername('admin');
        $user->setRoles(['ROLE_ADMIN']);

        $hashedPassword = $passwordHasher->hashPassword($user, 'admin');
        $user->setPassword($hashedPassword);
        $user->setEmail('admin@ohano.me');
        $user->setBits(0);
        $user->setActive(true);
        $user->setVerified(true);

        $doctrine->getManager()->persist($user);
        $doctrine->getManager()->flush();

        return $this->json([
            'message' => 'Admin user created',
        ]);
    }
}
