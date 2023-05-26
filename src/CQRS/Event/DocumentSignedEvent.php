<?php

declare(strict_types=1);

namespace App\CQRS\Event;

final class DocumentSignedEvent
{
    public function __construct(
        public int $documentId,
        public string $clientEmail,
        public string $comment,
    ) { }
}
