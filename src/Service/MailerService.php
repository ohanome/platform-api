<?php

namespace App\Service;

use App\Mail\OhanoMail;
use App\Mail\OhanoMailer;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class MailerService
{
    public function __construct(private readonly ContainerBagInterface $parameters)
    {
    }

    public function getMailer(OhanoMail $mail, bool $exceptions = true, bool $enableSmtp = true): OhanoMailer
    {
        $host = $this->parameters->get('app.smtp.host');
        $port = $this->parameters->get('app.smtp.port');
        $user = $this->parameters->get('app.smtp.user');
        $pass = $this->parameters->get('app.smtp.pass');
        $address = $this->parameters->get('app.smtp.address');

        return new OhanoMailer($mail, $host, $user, $pass, $address, $port, $exceptions, $enableSmtp);
    }
}