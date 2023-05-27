<?php

declare(strict_types=1);

namespace App\Mailer\ClientEmail;

interface MailerClient
{
    public function send(string $to, Content $content): void;
}
