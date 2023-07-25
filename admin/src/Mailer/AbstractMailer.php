<?php
namespace App\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class AbstractMailer
{

    public const MAILER_DEFAULT_EMITTER = 'contact@agathefrederick.fr';
    public const MAILER_DEFAULT_FALLBACK = 'agathefrederick@gmail.com';
    public const MAILER_DEFAULT_TEMPLATE = 'emails/layout.html.twig';

    public function __construct(
        private MailerInterface $mailer,
    ) {
    }

    public function send(
        string|array $to,
        string $emitter = self::MAILER_DEFAULT_EMITTER,
        string $subject = '',
        array $data = [],
        string $template = self::MAILER_DEFAULT_TEMPLATE,
    ): void {
        $to = is_string($to) ? $to : join(', ', $to);

        $email = (new TemplatedEmail())
            ->from($emitter)
            ->to($to)
            ->addBcc(self::MAILER_DEFAULT_FALLBACK)
            ->subject($subject)
            ->htmlTemplate($template)
            ->context($data);

        try {
            $this->mailer->send($email);
            return;
        } catch (TransportExceptionInterface $e) {
            throw new TransportException("Something went wrong while sending this email : {$e->getMessage()}");
        }

    }
}