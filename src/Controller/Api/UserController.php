<?php

namespace App\Controller\Api;

use App\Controller\ControllerBase;
use App\Entity\Activation;
use App\Entity\User;
use App\Error\ActivationCodeInvalidError;
use App\Error\ActivationCodeUsedError;
use App\Error\ActivationUserInvalidError;
use App\Service\ErrorService;
use App\Service\UserService;
use App\Service\Validator\RequestValidator;
use Doctrine\Persistence\ManagerRegistry;
use PHPMailer\PHPMailer\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/api/user', name: 'app_api_user_')]
class UserController extends ControllerBase
{
    #[Route('/', name: 'all', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function getAll(ManagerRegistry $doctrine): JsonResponse
    {
        $allUsers = $doctrine->getRepository(User::class)->findAll();
        return $this->sendJson('All users', data: $allUsers);
    }

    #[Route('/{id}', name: 'one', methods: ['GET'])]
    public function getOneById(User $user): JsonResponse
    {
        return $this->sendJson('User', data: $user);
    }

    #[Route('/', name: 'create', methods: ['POST'])]
    public function create(
        ManagerRegistry $doctrine,
        Request $request,
        RequestValidator $requestValidator,
        UserService $userService,
        ErrorService $errorService): JsonResponse
    {
        $errors = $requestValidator->validateUserCreateRequest($request, $doctrine);
        if (count($errors) > 0) {
            $builtErrors = $errorService->buildErrorMessages($errors);
            return $this->json(['errors' => $builtErrors], 400);
        }

        try {
            $user = $userService->createUserFromRequest($request);
        } catch (Exception $e) {
            return $this->json(['errors' => ['message' => $e->getMessage()]], 400);
        }

        return $this->json($user);
    }

    #[Route('/activate/{code}', name: 'activate', methods: ['GET'])]
    public function activateUser(string $code, ManagerRegistry $doctrine, ErrorService $errorService, TranslatorInterface $translator)
    {
        if ($this->getUser()->isActive()) {
            return $this->json(['message' => 'User is already active']);
        }

        /** @var Activation $activation */
        $activation = $doctrine->getRepository(Activation::class)->findOneBy(['code' => $code]);
        if (!$activation) {
            $error = new ActivationCodeInvalidError();
            return $this->json(['errors' => $errorService->buildErrorMessages([$error])], 400);
        }

        /** @var User $user */
        $user = $activation->getUser();
        if ($user->getId() !== $this->getUser()->getId()) {
            $error = new ActivationUserInvalidError();
            return $this->json(['errors' => $errorService->buildErrorMessages([$error])], 400);
        }

        if ($activation->isUsed()) {
            $error = new ActivationCodeUsedError();
            return $this->json(['errors' => $errorService->buildErrorMessages([$error])], 400);
        }

        $activation->setUsed(true);
        $doctrine->getManager()->persist($activation);

        $user->setActive(true);
        $doctrine->getManager()->persist($user);
        $doctrine->getManager()->flush();

        return $this->json(['message' => $translator->trans('user.account.activated')]);
    }
}
