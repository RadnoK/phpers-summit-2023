<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\DocumentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DocumentController extends AbstractController
{
    public function __construct(
        private readonly DocumentService $documentService,
    ) { }

    #[Route('/documents/{documentId}/sign', methods: ['POST'])]
    public function sign(Request $request): Response
    {
        $documentId = $request->attributes->get('documentId');

        $data = \json_decode((string) $request->getContent(), true);

        $this->documentService->sign($documentId, $data);

        return $this->json(['status' => 'OK'], Response::HTTP_OK);
    }

    #[Route('/documents', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = \json_decode((string) $request->getContent(), true);

        $document = $this->documentService->create($data);

        return $this->json($document, Response::HTTP_CREATED);
    }
}
