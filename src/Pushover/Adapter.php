<?php

declare(strict_types=1);

namespace MetaRush\Notifier\Pushover;

use MetaRush\Notifier\AdapterInterface;
use MetaRush\Notifier\Exception;

/**
 * Notify a Pushover account
 */
class Adapter implements AdapterInterface
{
    private \Pushover $pushover;

    /**
     *
     * @var array<Account>
     */
    private array $accounts;
    private string $subject;
    private string $body;

    /**
     *
     * @param \Pushover $pushover
     * @param array<Account> $accounts
     * @param string $subject
     * @param string $body
     */
    public function __construct(
        \Pushover $pushover,
        array $accounts,
        string $subject,
        string $body)
    {
        $this->pushover = $pushover;
        $this->accounts = $accounts;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     *
     * @return void
     * @throws Exception
     */
    public function send(): void
    {
        $this->pushover->setTitle($this->subject);
        $this->pushover->setMessage($this->body);

        $failedUsers = [];
        foreach ($this->accounts as $v) {

            /** @var Account $v */
            $this->pushover->setToken($v->getAppKey());
            $this->pushover->setUser($v->getUserKey());

            if (!$this->pushover->send())
                $failedUsers[] = $v->getUserKey();
        }

        if ($failedUsers) {

            $failedUsers = trim(\implode(', ', $failedUsers), ',');
            throw new Exception('Pushover failed sending to users: ' . $failedUsers);
        }
    }

}