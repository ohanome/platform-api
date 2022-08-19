<?php

namespace App\Error;

class PasswordMissingError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1401;
    }

    public static function getMessage(): string
    {
        return 'error.user.password.missing.message';
    }

    public static function getDescription(): string
    {
        return 'error.user.password.missing.description';
    }
}