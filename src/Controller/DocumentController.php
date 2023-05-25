<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\DocumentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
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

        $document = $this->documentService->create($data);

        return $this->json($document, Response::HTTP_CREATED);
    }

    #[Route('/documents/{id}/sign', methods: ['POST'])]
    public function sign(Request $request): Response
    {
        $documentId = $request->attributes->get('id');

        $data = \json_decode((string) $request->getContent(), true);

        $document = $this->documentService->get($documentId);
        $document->setSignedAt(new \DateTimeImmutable());
        $document->setSignatureHash(random_bytes(32));

        $this->documentService->save($document);

        $this->mailer->send((new Email())
            ->from('system@example.com')
            ->to($document->getClient()->getEmail())
            ->text($document->getSignatureComment())
        );

        return $this->json($document, Response::HTTP_OK);
    }
}
