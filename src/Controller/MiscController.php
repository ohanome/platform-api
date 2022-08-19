<?php

namespace App\Controller;

use App\Entity\Subscription;
use App\Entity\User;
use App\Service\AuditService;
use App\Service\MiscService;
use App\Service\SubscriptionService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

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
    public function createAdminUser(ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher, AuditService $auditService): JsonResponse
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
        $user->setCreated(new \DateTime());
        $user->setUpdated(new \DateTime());

        $doctrine->getManager()->persist($user);
        $doctrine->getManager()->flush();
        $auditService->new('Created admin user', $this->getUser());

        return $this->json([
            'message' => 'Admin user created',
        ]);
    }

    #[Route('/setup', name: 'setup', methods: ['GET'])]
    public function setup(
        ManagerRegistry $doctrine,
        SubscriptionService $subscriptionService,
        MiscService $miscService,
        AuditService $auditService
    ): JsonResponse
    {
        $subscriptionService->setupSubscriptions();
        $allUsers = $doctrine->getRepository(User::class)->findAll();
        foreach ($allUsers as $user) {
            $miscService->createMissingEntities($user);
        }

        /** @var User $adminUser */
        $adminUser = $doctrine->getRepository(User::class)->findOneBy(['username' => 'admin']);
        if ($adminUser) {
            /** @var Subscription $diamondPlusSubscription */
            $diamondPlusSubscription = $doctrine->getRepository(Subscription::class)->findOneBy(['name' => 'Diamond+']);

            $adminUser->setVerified(true);
            $adminUser->setActive(true);
            $adminUser->setBits(1000000000);
            if ($diamondPlusSubscription) {
                $adminUser->setSubscription($diamondPlusSubscription);
            }
            $adminUser->setUpdated(new \DateTime());
            $doctrine->getManager()->persist($adminUser);
            $doctrine->getManager()->flush();
        }

        $auditService->new('Triggered setup', $this->getUser());

        return $this->json([
            'message' => 'Setup complete',
        ]);
    }

    #[Route('/cleanup', name: 'cleanup', methods: ['GET'])]
    public function cleanup(ManagerRegistry $doctrine, MiscService $miscService, AuditService $auditService): JsonResponse {
        $allUsers = $doctrine->getRepository(User::class)->findAll();
        foreach ($allUsers as $user) {
            $miscService->createMissingEntities($user);
            try {
                $miscService->determineActiveProfile($user);
            } catch (\Exception $e) {
                return $this->json([
                    'message' => $e->getMessage(),
                ]);
            }
        }

        $auditService->new('Triggered cleanup', $this->getUser());

        return $this->json([
            'message' => 'Cleanup complete',
        ]);
    }

    #[Route('/locale-test', name: 'locale_test', methods: ['GET'])]
    public function localeTest(Request $request, TranslatorInterface $translator): JsonResponse
    {
        return $this->json([
            'message' => $translator->trans('test.locale'),
            'determined locale' => $request->getLocale(),
        ]);
    }
}
