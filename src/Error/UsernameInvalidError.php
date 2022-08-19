<?php

namespace App\Error;

class UsernameInvalidError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1205;
    }

    public static function getMessage(): string
    {
        return 'error.user.username.invalid.message';
    }

    public static function getDescription(): string
    {
        return 'error.user.username.invalid.description';
    }
}