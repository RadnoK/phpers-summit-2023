<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Document;
use App\Event\DocumentSignedEvent;
use App\Factory\DocumentFactory;
use App\Repository\DocumentRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final readonly class DocumentService
{
    public function __construct(
        private DocumentFactory $documentFactory,
        private DocumentRepository $documentRepository,
        private SignatureService $signatureService,
        private EventDispatcherInterface $eventDispatcher,
    ) { }

    public function create(array $document): Document
    {
        $entity = $this->documentFactory->create($document);

        $this->documentRepository->save($entity);

        return $entity;
    }

    public function save(Document $document): void
    {
        $this->documentRepository->save($document);
    }

    public function sign(int $documentId, array $data): void
    {
        /** @var Document $document */
        $document = $this->documentRepository->find($documentId);
        $document->setSignedAt(new \DateTimeImmutable());
        $document->setSignatureHash($this->signatureService->generate());
        $document->setSignatureComment($data['comment']);

        $this->documentRepository->save($document);

        $this->eventDispatcher->dispatch(new DocumentSignedEvent(
            documentId: $documentId,
            clientEmail: $document->getClient()->getEmail(),
            comment: $document->getSignatureComment(),
        ));
    }
}
