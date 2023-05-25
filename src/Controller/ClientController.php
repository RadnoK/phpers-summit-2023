<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ClientService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ClientController extends AbstractController
{
    public function __construct(
        private readonly ClientService $clientService,
    ) { }

    #[Route('/clients', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = \json_decode((string) $request->getContent(), true);

        $client = $this->clientService->create($data);

        return $this->json($client, Response::HTTP_CREATED);
    }
}
