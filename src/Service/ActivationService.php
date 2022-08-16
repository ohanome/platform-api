<?php

namespace App\Service;

use App\Entity\Activation;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Twig\Environment;

class ActivationService
{
    public function __construct(private readonly ManagerRegistry $doctrine, private readonly Environment $twig)
    {
    }

    public function createActivationForUser(User $user): void
    {
        $code = bin2hex(random_bytes(32));
        $activation = new Activation();
        $activation->setUser($user);
        $activation->setCode($code);
        $activation->setCreated(new \DateTime());
        $activation->setUpdated(new \DateTime());
        $this->doctrine->getManager()->persist($activation);
        $this->doctrine->getManager()->flush();

        $message = $this->twig->render('email/account_activation.html.twig', [
            'activation' => $activation,
        ]);
    }
}