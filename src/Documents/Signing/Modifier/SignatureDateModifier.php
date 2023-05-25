<?php

declare(strict_types=1);

namespace App\Documents\Signing\Modifier;

use App\Entity\Document;
use Symfony\Component\Clock\ClockInterface;

final class SignatureDateModifier
{
    public function __construct(
        private readonly ClockInterface $clock,
    ) { }

    public function signedNow(Document $document): void
    {
        $document->setSignedAt($this->clock->now());
    }
}
