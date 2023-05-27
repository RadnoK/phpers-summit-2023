<?php

declare(strict_types=1);

namespace App\Documents\Signing\Modifier;

use App\Documents\Signing\Payload\SignaturePayload;
use App\Entity\Document;

final class SignatureCommentModifier implements ModifierInterface
{
    public function __invoke(Document $document, SignaturePayload $signature): void
    {
        $document->setSignatureComment($signature->comment);
    }

    public function isEligible(Document $document, SignaturePayload $signature): bool
    {
        return $signature->comment !== null;
    }
}
