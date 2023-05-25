<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Client;

final class ClientFactory
{
    public function create(array $client): Client
    {
        return new Client();
    }
}
