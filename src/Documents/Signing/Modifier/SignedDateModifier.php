<?php

declare(strict_types=1);

namespace App\Documents\Signing\Modifier;

use App\Documents\Signing\Payload\SignaturePayload;
use App\Entity\Document;
use Symfony\Component\Clock\ClockInterface;

final class SignedDateModifier implements ModifierInterface
{
    public function __construct(
        private readonly ClockInterface $clock,
    ) { }

    public function __invoke(Document $document, SignaturePayload $signature): void {
        $document->setSignedAt($this->clock->now());
    }

    public function isEligible(Document $document, SignaturePayload $signature): bool {
        return true;
    }
}
