<?php

declare(strict_types=1);

namespace App\Service;

final class SignatureService
{
    public function generate(): string
    {
        return random_bytes(32);
    }
}
