<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'app_api_')]
class ApiController extends ControllerBase
{
    #[Route('/', name: 'index')]
    public function index(): JsonResponse
    {
        return $this->sendJson('Api index');
    }

    #[Route('/me', name: 'me', methods: ['GET'])]
    public function getMe(): JsonResponse
    {
        return $this->sendJson("Fetched user", data: $this->getUser());
    }
}
