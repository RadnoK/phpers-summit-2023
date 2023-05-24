<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\DocumentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class DocumentController extends AbstractController
{
    public function __construct(
        private readonly DocumentService $documentService,
    ) { }

    public function create(Request $request): Response
    {
        $data = \json_decode((string) $request->getContent(), true);

        $document = $this->documentService->create($data);

        return $this->json($document, Response::HTTP_CREATED);
    }
}
