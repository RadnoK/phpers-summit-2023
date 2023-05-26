<?php

declare(strict_types=1);

namespace App\Documents\Signing;

use App\Documents\Signing\Modifier\ModifierInterface;

final class ModifierRegistry
{
    /** @var iterable|ModifierInterface[] */
    private iterable $modifiers;

    public function __construct(ModifierInterface ...$modifiers)
    {
        $this->modifiers = $modifiers;
    }

    public function all(): iterable
    {
        return $this->modifiers;
    }
}
