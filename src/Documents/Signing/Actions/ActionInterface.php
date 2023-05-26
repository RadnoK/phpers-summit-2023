<?php

declare(strict_types=1);

namespace App\Documents\Signing\Actions;

use App\Entity\Document;

interface ActionInterface
{
    public function isEligible(Document $document): bool;
}
