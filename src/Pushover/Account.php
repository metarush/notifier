<?php

declare(strict_types=1);

namespace MetaRush\Notifier\Pushover;

class Account
{
    private string $appKey;
    private string $userKey;

    public function getAppKey(): string
    {
        return $this->appKey;
    }

    public function getUserKey(): string
    {
        return $this->userKey;
    }

    public function setAppKey(string $appKey): self
    {
        $this->appKey = $appKey;
        return $this;
    }

    public function setUserKey(string $userKey): self
    {
        $this->userKey = $userKey;
        return $this;
    }

}