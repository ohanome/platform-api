<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Service\UserService;
use App\Service\Validator\RequestValidator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/user', name: 'app_api_user_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'all', methods: ['GET'])]
    public function getAll(ManagerRegistry $doctrine): JsonResponse
    {
        $allUsers = $doctrine->getRepository(User::class)->findAll();
        return $this->json($allUsers);
    }

    #[Route('/{id}', name: 'one', methods: ['GET'])]
    public function getOneById(User $user): JsonResponse
    {
        return $this->json($user);
    }

    #[Route('/', name: 'create', methods: ['POST'])]
    public function create(ManagerRegistry $doctrine, Request $request, RequestValidator $requestValidator, UserService $userService): JsonResponse
    {
        $data = $request->toArray();

        $errors = $requestValidator->validateUserCreateRequest($request, $doctrine);
        if (count($errors) > 0) {
            return $this->json(['data' => $data, 'errors' => $errors], 400);
        }

        $user = $userService->createUserFromRequest($request);

        return $this->json([$data, $user]);

        $user = new User();
//        $user->setUsername('test');
//        $user->setPassword('test');
//        $user->setEmail('');
//        $user->setRoles(['ROLE_USER']);
//        $doctrine->getManager()->persist($user);
//        $doctrine->getManager()->flush();
        return $this->json($user);
    }
}
