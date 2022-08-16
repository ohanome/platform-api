<?php

namespace App\Service;

use App\Entity\Activation;
use App\Entity\BaseProfile;
use App\Entity\Profile;
use App\Entity\User;
use App\Entity\Verification;
use App\Option\ProfileType;
use Doctrine\Persistence\ManagerRegistry;

class MiscService {

    public function __construct(private readonly ManagerRegistry $doctrine, private readonly ActivationService $activationService)
    {
    }

    public function createMissingEntities(User $user): void
    {
        $createdNewEntities = false;
        $existingVerification = $this->doctrine->getRepository(Verification::class)->findOneBy(['user' => $user]);
        if (!$existingVerification) {
            $verification = new Verification();
            $verification->setUser($user);
            $verification->setCreated(new \DateTime());
            $verification->setUpdated(new \DateTime());
            $this->doctrine->getManager()->persist($verification);
            $createdNewEntities = true;
        }

        $existingProfile = $this->doctrine->getRepository(Profile::class)->findOneBy(['user' => $user]);
        if (!$existingProfile) {
            $profile = new Profile();
            $profile->setUser($user);
            $profile->setName($user->getUsername());
            $profile->setType(ProfileType::Personal->value);
            $profile->setCreated(new \DateTime());
            $profile->setUpdated(new \DateTime());
            $this->doctrine->getManager()->persist($profile);

            $baseProfile = new BaseProfile();
            $baseProfile->setProfile($profile);
            $baseProfile->setCreated(new \DateTime());
            $baseProfile->setUpdated(new \DateTime());
            $this->doctrine->getManager()->persist($baseProfile);

            $createdNewEntities = true;
        } else {
            $baseProfileExists = $this->doctrine->getRepository(BaseProfile::class)->findOneBy(['profile' => $existingProfile]);
            if (!$baseProfileExists) {
                $baseProfile = new BaseProfile();
                $baseProfile->setProfile($existingProfile);
                $baseProfile->setCreated(new \DateTime());
                $baseProfile->setUpdated(new \DateTime());
                $this->doctrine->getManager()->persist($baseProfile);
                $createdNewEntities = true;
            }
        }

        $existingActivation = $this->doctrine->getRepository(Activation::class)->findOneBy(['user' => $user]);
        if (!$existingActivation) {
            $this->activationService->createActivationForUser($user);
            // If no activation has been found for the user, we assume it hasn't been created yet.
            $user->setActive(false);
            $this->doctrine->getManager()->persist($user);
            $createdNewEntities = true;
        }

        if ($createdNewEntities) {
            $this->doctrine->getManager()->flush();
        }
    }

    /**
     * @throws \Exception
     */
    public function determineActiveProfile(User $user): void
    {
        if ($user->getActiveProfile()) {
            // Since the user already has a profile set as active profile, we can safely return here.
            return;
        }

        $personalProfile = $this->doctrine->getRepository(Profile::class)->findOneBy(['user' => $user, 'type' => ProfileType::Personal->value]);
        if ($personalProfile) {
            $user->setActiveProfile($personalProfile);
            $user->setUpdated(new \DateTime());
            $this->doctrine->getManager()->persist($user);
            $this->doctrine->getManager()->flush();
            return;
        } else {
            throw new \Exception('No personal profile found for user ' . $user->getUsername());
        }
    }

}