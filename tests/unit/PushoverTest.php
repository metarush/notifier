<?php

declare(strict_types=1);

namespace Tests;

use MetaRush\Notifier\Notifier;
use MetaRush\Notifier\Pushover\Builder;

class PushoverTest extends Common
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_send_validRequest_pass()
    {
        $notifiers = [
                (new Builder)
                ->addAccount($_ENV['MRN_PUSHOVER_APP_KEY'], $_ENV['MRN_PUSHOVER_USER_KEY'])
                ->setSubject('Testing MR Pushover notifier')
                ->setBody('Does it work')
                ->build()
        ];

        (new Notifier($notifiers))
            ->send();

        // ------------------------------------------------

        $this->assertNull(null);
    }

    public function test_send_pushoverWrongCreds_throwEx()
    {
        $this->expectExceptionMessageMatches('/Pushover failed/');

        // ------------------------------------------------

        $notifiers = [
                (new Builder)
                ->addAccount('non existing account', 'testing')
                ->setSubject('test')
                ->setBody('test')
                ->build()
        ];

        (new Notifier($notifiers))
            ->send();
    }

}