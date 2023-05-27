<?php

declare(strict_types=1);

namespace App\Mailer\ClientEmail;

final class MailerService
{
    public function __construct(
        private readonly MailerClient $mailerClient,
    ) { }

    public function send(Content $content): void
    {
        $this->mailerClient->send($content);
    }
}
