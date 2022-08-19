<?php

namespace App\Error;

class EmailMissingError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1303;
    }

    public static function getMessage(): string
    {
        return 'error.email.missing.message';
    }

    public static function getDescription(): string
    {
        return 'error.email.missing.description';
    }
}