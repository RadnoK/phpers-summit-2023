<?php

declare(strict_types=1);

namespace App\CQRS\Message;

use App\CQRS\Event\DocumentSignedEvent;

final class DocumentSignerMessageHandler
{
    public function __construct()
    {
    }

    public function __invoke(DocumentSignedEvent $event): void
    {
    }
}
