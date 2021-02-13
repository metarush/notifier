<?php

declare(strict_types=1);

namespace MetaRush\Notifier;

interface AdapterInterface
{
    public function send(): void;
}