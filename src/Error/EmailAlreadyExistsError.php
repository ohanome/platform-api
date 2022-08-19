<?php

namespace App\Error;

class EmailAlreadyExistsError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1301;
    }

    public static function getMessage(): string
    {
        return 'error.email.already_exists.message';
    }

    public static function getDescription(): string
    {
        return 'error.email.already_exists.description';
    }
}