<?php

declare(strict_types=1);

namespace MetaRush\Notifier\Email;

use MetaRush\EmailFallback\Builder as EmailFallbackBuilder;

class Builder
{
    private EmailFallbackBuilder $emailFallbackBuilder;

    public function build(): Adapter
    {
        return new Adapter($this->emailFallbackBuilder);
    }

    public function setEmailFallbackBuilder(EmailFallbackBuilder $emailfallbackBuilder): self
    {
        $this->emailFallbackBuilder = $emailfallbackBuilder;

        return $this;
    }

}