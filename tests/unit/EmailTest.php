<?php

declare(strict_types=1);

namespace Tests;

use MetaRush\Notifier\Notifier;
use MetaRush\Notifier\Email\Builder as EmailNotifierBuilder;
use MetaRush\EmailFallback\Builder as EmailFallbackBuilder;
use MetaRush\EmailFallback\Server;

class EmailTest extends Common
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_send_validRequest_pass()
    {
        $servers = [
                (new Server)
                ->setHost($_ENV['MRN_SMTP_HOST'])
                ->setUser($_ENV['MRN_SMTP_USER'])
                ->setPass($_ENV['MRN_SMTP_PASS'])
                ->setPort((int) $_ENV['MRN_SMTP_PORT'])
                ->setEncr($_ENV['MRN_SMTP_ENCR'])
        ];

        $emailFallbackBuilder = (new EmailFallbackBuilder)
            ->setServers($servers)
            ->setTos(['test@example.com'])
            ->setSubject('Testing MR email notifier')
            ->setBody('Does it work')
            ->setFromEmail('test@example.com');

        $notifiers = [
                (new EmailNotifierBuilder)
                ->setEmailFallbackBuilder($emailFallbackBuilder)
                ->build()
        ];

        (new Notifier($notifiers))
            ->send();

        // ------------------------------------------------

        $this->assertNull(null);
    }

    public function test_send_invalidServers_throwEx()
    {
        $this->expectExceptionMessageMatches('/Email notifier failed/');

        // ------------------------------------------------

        $servers = [
                (new Server)
                ->setHost('invalid smtp host')
                ->setUser($_ENV['MRN_SMTP_USER'])
                ->setPass($_ENV['MRN_SMTP_PASS'])
                ->setPort((int) $_ENV['MRN_SMTP_PORT'])
                ->setEncr($_ENV['MRN_SMTP_ENCR'])
        ];

        $emailFallbackBuilder = (new EmailFallbackBuilder)
            ->setServers($servers)
            ->setTos(['test@example.com'])
            ->setSubject('Testing MR email notifier')
            ->setBody('Does it work')
            ->setFromEmail('test@example.com');

        $notifiers = [
                (new EmailNotifierBuilder)
                ->setEmailFallbackBuilder($emailFallbackBuilder)
                ->build()
        ];

        (new Notifier($notifiers))
            ->send();
    }

}