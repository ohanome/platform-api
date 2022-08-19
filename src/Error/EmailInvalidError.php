<?php

namespace App\Error;

class EmailInvalidError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1302;
    }

    public static function getMessage(): string
    {
        return 'error.email.invalid.message';
    }

    public static function getDescription(): string
    {
        return 'error.email.invalid.description';
    }
}