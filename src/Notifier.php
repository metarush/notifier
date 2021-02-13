<?php

declare(strict_types=1);

namespace MetaRush\Notifier;

class Notifier
{
    /**
     *
     * @var array<AdapterInterface>
     */
    private array $adapters;

    /**
     *
     * @param array<AdapterInterface> $adapters
     */
    public function __construct(array $adapters)
    {
        $this->adapters = $adapters;
    }

    public function send(): void
    {
        foreach ($this->adapters as $v)
            $v->send();
    }

}