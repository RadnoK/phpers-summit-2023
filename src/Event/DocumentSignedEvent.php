<?php

declare(strict_types=1);

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

final class DocumentSignedEvent extends Event
{
    public function __construct(
        public readonly int $documentId,
        public readonly string $clientEmail,
        public readonly string $comment,
    ) { }
}
