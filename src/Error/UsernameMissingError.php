<?php

namespace App\Error;

class UsernameMissingError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1204;
    }

    public static function getMessage(): string
    {
        return 'error.username.missing.message';
    }

    public static function getDescription(): string
    {
        return 'error.username.missing.description';
    }
}