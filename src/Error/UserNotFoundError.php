<?php

namespace App\Error;

class UserNotFoundError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1203;
    }

    public static function getMessage(): string
    {
        return 'error.user.not_found.message';
    }

    public static function getDescription(): string
    {
        return 'error.user.not_found.description';
    }
}