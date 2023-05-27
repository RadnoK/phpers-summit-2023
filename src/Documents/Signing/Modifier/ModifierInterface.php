<?php

declare(strict_types=1);

namespace App\Documents\Signing\Modifier;

use App\Documents\Signing\Payload\SignaturePayload;
use App\Entity\Document;

interface ModifierInterface
{
    public function isEligible(Document $document, SignaturePayload $signature): bool;
}
