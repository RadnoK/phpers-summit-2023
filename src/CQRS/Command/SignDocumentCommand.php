<?php

declare(strict_types=1);

namespace App\CQRS\Command;

final class SignDocumentCommand
{
    public function __construct(
        public int $documentId,
        public string $comment,
    ) { }
}
