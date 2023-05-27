<?php

declare(strict_types=1);

namespace App\Documents\Signing\Processor;

use App\Documents\Signing\ActionsRegistry;
use App\Documents\Signing\ModifierRegistry;
use App\Documents\Signing\Payload\SignaturePayload;
use App\Entity\Document;

final class ClientSignatureProcessor
{
    public function __construct(
        private readonly ActionsRegistry $actionsRegistry,
        private readonly ModifierRegistry $modifierRegistry,
    ) { }

    public function process(Document $document, SignaturePayload $signature): void
    {
        foreach ($this->modifierRegistry->all() as $modifier) {
            if ($modifier->isEligible($document)) {
                $modifier($document, $signature);
            }
        }

        foreach ($this->actionsRegistry->all() as $action) {
            if ($action->isEligible($document)) {
                $action($document, $signature);
            }
        }
    }
}
