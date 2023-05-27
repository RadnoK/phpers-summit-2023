<?php

declare(strict_types=1);

namespace App\Documents\Signing\Payload;

final class SignaturePayload
{
    public function __construct(
        public readonly string $comment,
    ) { }
}
