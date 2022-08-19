<?php

namespace App\Service;

use App\Entity\Activation;
use App\Entity\User;
use App\Exception\MissingAccountActivationException;
use App\Mail\OhanoMail;
use App\Mail\OhanoMailer;
use App\Ohano;
use Doctrine\Persistence\ManagerRegistry;
use PHPMailer\PHPMailer\Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class ActivationService
{
    public function __construct(
        private readonly ManagerRegistry $doctrine,
        private readonly Environment $twig,
        private readonly TranslatorInterface $translator,
        private readonly MailerService $mailerService,
        private readonly ContainerBagInterface $parameters,
    )
    {
    }

    /**
     * @param User $user
     * @throws ContainerExceptionInterface
     * @throws Exception
     * @throws LoaderError
     * @throws MissingAccountActivationException
     * @throws NotFoundExceptionInterface
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createActivationForUser(User $user): void
    {
        $code = bin2hex(random_bytes(32));
        $activation = new Activation();
        $activation->setUser($user);
        $activation->setCode($code);
        $activation->setUsed($user->isActive());
        $activation->setCreated(new \DateTime());
        $activation->setUpdated(new \DateTime());

        $this->sendActivationMail($user, $activation);
        $this->doctrine->getManager()->persist($activation);
        $this->doctrine->getManager()->flush();
    }

    /**
     * @param User $user
     * @param Activation|null $activation
     * @return OhanoMailer
     * @throws Exception
     * @throws LoaderError
     * @throws MissingAccountActivationException
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function buildActivationMail(User $user, Activation $activation = null): OhanoMailer
    {
        if (empty($activation)) {
            /** @var Activation $activation */
            $activation = $this->doctrine->getRepository(Activation::class)->findOneBy(['user' => $user]);
        }
        if (!$activation) {
            throw new MissingAccountActivationException('No activation found for user');
        }
        $mail = $this->mailerService->getMailer(OhanoMail::AccountActivation);
        $mail->addAddress($user->getEmail());
        $mail->Subject = $this->translator->trans('user.account.activation') . ' - ohano';
        $mail->renderBody($this->twig, [
            'username' => $user->getUsername(),
            'link' => $this->parameters->get('app.frontend.url') . '/activate/' . $activation->getCode(),
        ]);
        return $mail;
    }

    /**
     * @param User $user
     * @param Activation|null $activation
     * @throws ContainerExceptionInterface
     * @throws Exception
     * @throws LoaderError
     * @throws MissingAccountActivationException
     * @throws NotFoundExceptionInterface
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function sendActivationMail(User $user, Activation $activation = null): void
    {
        $mail = $this->buildActivationMail($user, $activation);
        $mail->send();
    }
}