<?php

declare(strict_types=1);

namespace App\Service;

use App\Documents\Signing\Processor\ClientSignatureProcessor;
use App\Entity\Document;
use App\Factory\DocumentFactory;
use App\Repository\DocumentRepository;

final readonly class DocumentService
{
    public function __construct(
        private DocumentFactory $documentFactory,
        private DocumentRepository $documentRepository,
        private ClientSignatureProcessor $clientSignatureProcessor,
    ) { }

    public function create(array $document): Document
    {
        $entity = $this->documentFactory->create($document);

        $this->documentRepository->save($entity);

        return $entity;
    }

    public function sign(int $documentId, array $signature): void
    {
        $document = $this->documentRepository->find($documentId);

        $this->clientSignatureProcessor->process($client, $document, $signature);
    }

    public function get(int $documentId): Document
    {
        return $this->documentRepository->find($documentId);
    }

    public function save(Document $document): void
    {
        $this->documentRepository->save($document);
    }
}
