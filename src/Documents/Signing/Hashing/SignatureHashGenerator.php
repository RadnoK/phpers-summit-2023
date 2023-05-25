<?php

declare(strict_types=1);

namespace App\Documents\Signing\Hashing;

use function random_bytes;

final class SignatureHashGenerator
{
    public function generate(): string
    {
        return random_bytes(32);
    }
}
