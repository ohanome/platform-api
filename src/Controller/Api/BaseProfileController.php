<?php

namespace App\Controller\Api;

use App\Entity\BaseProfile;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/base-profile', name: 'app_api_base_profile_')]
class BaseProfileController extends AbstractController
{
    #[Route('/', name: 'all', methods: ['GET'])]
    public function getAll(ManagerRegistry $doctrine): JsonResponse
    {
        $allBaseProfiles = $doctrine->getRepository(BaseProfile::class)->findAll();
        return $this->json($allBaseProfiles);
    }
    #[Route('/{id}', name: 'all', methods: ['GET'])]
    public function getOne(BaseProfile $baseProfile): JsonResponse
    {
        return $this->json($baseProfile);
    }
}
