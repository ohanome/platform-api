<?php

namespace App\Error;

class UsernameAlreadyExistsError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1201;
    }

    public static function getMessage(): string
    {
        return 'error.username.already_exists.message';
    }

    public static function getDescription(): string
    {
        return 'error.username.already_exists.description';
    }
}