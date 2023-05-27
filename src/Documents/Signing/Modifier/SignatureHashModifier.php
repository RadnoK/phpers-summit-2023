<?php

declare(strict_types=1);

namespace App\Documents\Signing\Modifier;

use App\Documents\Signing\Hashing\SignatureHashGenerator;
use App\Documents\Signing\Payload\SignaturePayload;
use App\Entity\Document;

final class SignatureHashModifier implements ModifierInterface
{
    public function __construct(
        private readonly SignatureHashGenerator $signatureHashGenerator,
    ) { }

    public function __invoke(Document $document, SignaturePayload $signature): void
    {
        $document->setSignatureHash($this->signatureHashGenerator->generate());
    }

    public function isEligible(Document $document, SignaturePayload $signature): bool
    {
        return true;
    }
}
