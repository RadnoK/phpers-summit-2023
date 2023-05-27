<?php

declare(strict_types=1);

namespace App\Mailer\ClientEmail;

final class Content
{
    public function __construct(
        public readonly string $subject,
        public readonly string $hero,
        public readonly string $content,
        public readonly string $callToAction,
    ) { }
}
