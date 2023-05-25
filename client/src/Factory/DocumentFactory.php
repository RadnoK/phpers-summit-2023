<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Document;

final class DocumentFactory
{
    public function create(array $document): Document
    {
        return new Document();
    }
}
