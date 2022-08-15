<?php

namespace App\Controller\Api;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/admin', name: 'app_api_admin_')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AdminController.php',
        ]);
    }

    #[Route('/all-users', name: 'all_users', methods: ['GET'])]
    public function getAllUsers(ManagerRegistry $doctrine): JsonResponse
    {
        $allUsers = $doctrine->getRepository(User::class)->findAll();
        return $this->json($allUsers);
    }
}
