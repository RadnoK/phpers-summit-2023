<?php

declare(strict_types=1);

namespace App\Controller;

use App\CQRS\Command\CreateDocumentCommand;
use App\CQRS\Command\SignDocumentCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

final class DocumentController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
    ) { }

    #[Route('/documents', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = \json_decode((string) $request->getContent(), true);

        $document = $this->messageBus->dispatch(new CreateDocumentCommand(
            $data['name'],
            $data['content'],
            $data['clientId'],
        ));

        return $this->json($document, Response::HTTP_CREATED);
    }

    #[Route('/documents/{id}/sign', methods: ['POST'])]
    public function sign(Request $request): Response
    {
        $documentId = $request->attributes->get('id');

        $data = \json_decode((string) $request->getContent(), true);

        $document = $this->messageBus->dispatch(new SignDocumentCommand(
            documentId: $documentId,

        ));

        return $this->json($document, Response::HTTP_OK);
    }
}
