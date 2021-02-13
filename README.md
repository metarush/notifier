# metarush/notifier

Send multiple notifications using notifiers like email, Pushover, etc.

## Install

Install via composer as `metarush/notifier`

## Sample usage

Let's send an email and Pushover notification

```php

use MetaRush\Notifier\Notifier;
use MetaRush\Notifier\Exception;
use MetaRush\Notifier\Pushover\Builder as PushoverNotifier;
use MetaRush\Notifier\Email\Builder as EmailNotifier;
use MetaRush\EmailFallback\Builder as EmailBuilder;
use MetaRush\EmailFallback\Server;

// ------------------------------------------------

// define a Pushover notifier

// you can use `addAccount()` multiple times for additional accounts

$pushoverNotifier = (new PushoverNotifier)
                        ->addAccount('pushover_app_key', 'pushover_user_key')
                        ->setSubject('test subject')
                        ->setBody('test body')
                        ->build();

// ------------------------------------------------

// define an email notifier

// you can use multiple STMP servers for failover (see package `metarush/email-fallback` for more options)

$servers = [
        (new Server)
            ->setHost('smtp_host')
            ->setUser('smtp_user')
            ->setPass('smtp_pass'])
            ->setPort(465)
            ->setEncr('TLS')
];

$emailBuilder = (new EmailBuilder)
                    ->setServers($servers)
                    ->setTos(['test@example.com'])
                    ->setSubject('test subject')
                    ->setBody('test body')
                    ->setFromEmail('test@example.com');

$emailNotifier = (new EmailNotifier)
                    ->setEmailFallbackBuilder($emailBuilder)
                    ->build()

// ------------------------------------------------

// put them together and send

$notifiers = [
    $pushoverNotifier,
    $emailNotifier
];

(new Notifier($notifiers))
    ->send();

```

## Current notifiers

- Email
- Pushover

Feel free to use or contribute your own notifier. Use the Pushover notifier as starting guide.