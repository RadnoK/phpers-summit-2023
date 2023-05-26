<?php

declare(strict_types=1);

namespace App\Documents\Signing;

use App\Documents\Signing\Actions\ActionInterface;

final class ActionsRegistry
{
    /** @var iterable|ActionInterface[] */
    private iterable $actions;

    public function __construct(ActionInterface ...$actions)
    {
        $this->actions = $actions;
    }

    public function all(): iterable
    {
        return $this->actions;
    }
}
