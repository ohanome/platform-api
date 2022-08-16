<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/register', name: 'app_api_register_')]
class RegisterController extends AbstractController
{
    #[Route('/', name: 'register', methods: ['POST'])]
    public function register(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/RegisterController.php',
        ]);
    }
}
