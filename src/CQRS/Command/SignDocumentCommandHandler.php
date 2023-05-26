<?php

declare(strict_types=1);

namespace App\CQRS\Command;

use App\CQRS\Event\DocumentSignedEvent;
use App\Domain\Entity\Document;
use App\Domain\Repository\DocumentRepository;
use Symfony\Component\Clock\ClockInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class SignDocumentCommandHandler
{
    public function __construct(
        private DocumentRepository $documentRepository,
        private ClockInterface $clock,
        private MessageBusInterface $eventBus,
    ) { }

    public function __invoke(SignDocumentCommand $command): void {
        /** @var Document $document */
        $document = $this->documentRepository->find($command->documentId);
        $document->setSignedAt($this->clock->now());
        $document->setSignatureComment($command->comment);
        $document->setSignatureHash($this->generateHash());

        $this->documentRepository->save($document);

        $this->eventBus->dispatch(new DocumentSignedEvent(
            documentId: $document->getId(),
            clientEmail: $document->getClient()->getEmail(),
            comment: $document->getSignatureComment(),
        ));
    }

    private function generateHash(): string
    {
        return random_bytes(32);
    }
}
