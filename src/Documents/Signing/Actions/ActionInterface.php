<?php

declare(strict_types=1);

namespace App\Documents\Signing\Actions;

use App\Documents\Signing\Payload\SignaturePayload;
use App\Entity\Document;

interface ActionInterface
{
    public function isEligible(Document $document, SignaturePayload $signature): bool;
}
