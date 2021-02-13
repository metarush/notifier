<?php

declare(strict_types=1);

namespace MetaRush\Notifier\Pushover;

class Builder
{
    /**
     *
     * @var array<Account>
     */
    private array $accounts;
    private string $subject;
    private string $body;

    public function build(): Adapter
    {
        $pushover = new \Pushover;

        return new Adapter(
            $pushover,
            $this->accounts,
            $this->subject,
            $this->body);
    }

    public function addAccount(string $appKey, string $userKey): self
    {
        $this->accounts[] = (new Account())
            ->setAppKey($appKey)
            ->setUserKey($userKey);

        return $this;
    }

    function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

}