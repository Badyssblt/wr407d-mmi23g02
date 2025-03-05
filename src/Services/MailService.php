<?php

namespace App\Services;

use App\Repository\UserRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Environment;

class MailService
{
    private $mailer;
    private $twig;
    private $params;

    private UserRepository $userRepository;

    public function __construct(MailerInterface $mailer, Environment $twig, ParameterBagInterface $params, UserRepository $userRepository)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->params = $params;
        $this->userRepository = $userRepository;
    }

    public function sendMail(string $recipientEmail, string $subject, string $templateName, array $context = [])
    {
        $htmlContent = $this->twig->render($templateName, $context);

        $email = (new Email())
            ->from("mmi23g02@mmi-troyes.fr")
            ->to($recipientEmail)
            ->subject($subject)
            ->html($htmlContent);

        $this->mailer->send($email);
    }

    public function sendMailToAll(): void
    {
        $users = $this->userRepository->findAll();

        foreach ($users as $user) {
            $this->sendMail($user->getEmail(), "Nouvelle voiture créées !", "mails/car_created.html.twig");
        }
    }
}
