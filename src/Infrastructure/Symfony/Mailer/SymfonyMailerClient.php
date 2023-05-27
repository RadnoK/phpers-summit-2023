<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Mailer;

use App\Mailer\ClientEmail\Content;
use App\Mailer\ClientEmail\MailerClient;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class SymfonyMailerClient implements MailerClient
{
    public function __construct(
        private readonly MailerInterface $mailer,
    ) { }

    public function send(string $to, Content $content): void
    {
        $this->mailer->send((new Email())
            ->from('system@example.com')
            ->to($to)
            ->subject($content->subject)
            ->text($content->hero . $content->content . $content->callToAction)
        );
    }
}
