<?php

namespace App\Error;

class UsernameBlockedError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1202;
    }

    public static function getMessage(): string
    {
        return 'error.username.blocked.message';
    }

    public static function getDescription(): string
    {
        return 'error.username.blocked.description';
    }
}