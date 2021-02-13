<?php

declare(strict_types=1);

namespace MetaRush\Notifier\Email;

use MetaRush\Notifier\AdapterInterface;
use MetaRush\Notifier\Exception;
use MetaRush\EmailFallback\Builder;

/**
 * Notify emails
 */
class Adapter implements AdapterInterface
{
    private Builder $emailBuilder;

    public function __construct(Builder $emailBuilder)
    {
        $this->emailBuilder = $emailBuilder;
    }

    public function send(): void
    {
        try {

            $mailer = $this->emailBuilder->build();
            $mailer->sendEmailFallback();

        } catch (\Exception $ex) {

            throw new Exception('Email notifier failed: ' . $ex->getMessage());
        }
    }

}