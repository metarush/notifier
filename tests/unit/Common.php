<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

class Common extends TestCase
{
    protected function setUp(): void
    {
        // ----------------------------------------------
        // load test credentials from .env to $_ENV
        // ----------------------------------------------
        try {

            $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();

        } catch (\Dotenv\Exception\InvalidPathException $ex) {

            echo "\r\n" . $ex->getMessage() . "\r\n\r\n"
            . 'Instructions: Create a .env file inside tests/unit/ and use the '
            . 'content of sample.env as template';
        }
    }

}