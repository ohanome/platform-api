<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use Twig\Environment;

class OhanoMailer extends PHPMailer
{
    /**
     * @var string The filename to put into "mail/$templatename.html.twig"
     */
    private string $templateName;

    public function __construct(OhanoMail $mail, string $host, string $user, string $password, string $address, int $port, bool $exceptions = null, $enableSmtp = true)
    {
        $this->templateName = $mail->value;
        $this->isHTML();

        $this->Host = $host;
        $this->Username = $user;
        $this->From = $address;
        $this->Sender = $address;
        $this->FromName = 'ohano';
        $this->Password = $password;
        $this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->Port = $port;

        parent::__construct($exceptions);

        if ($enableSmtp) {
            $this->isSMTP();
            $this->SMTPAuth = true;
        }
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