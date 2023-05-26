<?php

declare(strict_types=1);

namespace App\Documents\Signing\Processor;

use App\Documents\Signing\Actions\ActionInterface;
use App\Documents\Signing\ActionsRegistry;
use App\Documents\Signing\ModifierRegistry;
use App\Entity\Document;

final class ClientSignatureProcessor
{
    public function __construct(
        private readonly ActionsRegistry $actionsRegistry,
        private readonly ModifierRegistry $modifierRegistry,
    ) { }

    public function process($client, ?Document $document, array $signature)
    {
        foreach ($this->modifierRegistry->all() as $modifier) {
            if ($modifier->isEligible($document)) {
                $modifier($client, $document, $signature);
            }
        }

        foreach ($this->actionsRegistry->all() as $action) {
            if ($action->isEligible($document)) {
                $action($client, $document, $signature);
            }
        }
    }
}
