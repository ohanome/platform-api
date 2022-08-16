<?php

namespace App\Service;

use App\Entity\Audit;
use App\Entity\Profile;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

class AuditService {

    public function __construct(private readonly ManagerRegistry $doctrine)
    {
    }

    public function new(string $message, User|UserInterface $user = null, ?Profile $profile = null): void {
        $audit = new Audit();
        $audit->setMessage($message);
        $audit->setUser($user);
        $audit->setProfile($profile);
        $audit->setCreated(new \DateTime());
        $audit->setUpdated(new \DateTime());
        $this->doctrine->getManager()->persist($audit);
        $this->doctrine->getManager()->flush();
    }

}