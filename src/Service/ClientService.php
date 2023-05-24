<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Client;
use App\Factory\ClientFactory;
use App\Repository\ClientRepository;

final readonly class ClientService
{
    public function __construct(
        private ClientFactory $clientFactory,
        private ClientRepository $clientRepository,
    ) { }

    public function create(array $client): Client
    {
        $entity = $this->clientFactory->create($client);

        $this->clientRepository->save($entity);

        return $entity;
    }
}
