<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use Twig\Environment;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class OhanoMailer extends PHPMailer
{
    /**
     * @var string The filename to put into "mail/$templatename.html.twig"
     */
    private string $templateName;

    public function __construct(OhanoMail $mail, bool $exceptions = null)
    {
        $this->templateName = $mail->value;
        $this->isHTML();

        $this->Host = env('SMTP_HOST');
        $this->Username = env('SMTP_USER');
        $this->From = env('SMTP_ADDRESS');
        $this->Sender = env('SMTP_ADDRESS');
        $this->FromName = 'ohano';
        $this->Password = env('SMTP_PASS');
        $this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->Port = env('SMTP_PORT');

        parent::__construct($exceptions);

        $this->isSMTP();
        $this->SMTPAuth = true;
    }

    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function renderBody(Environment $twig, array $data): OhanoMailer
    {
        $this->Body = $twig->render('mail/' . $this->templateName . '.html.twig', $data);
        return $this;
    }

}