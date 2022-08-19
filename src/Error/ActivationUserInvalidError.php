<?php

namespace App\Error;

class ActivationUserInvalidError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1104;
    }

    public static function getMessage(): string
    {
        return 'error.user.activation.user.invalid.message';
    }

    public static function getDescription(): string
    {
        return 'error.user.activation.user.invalid.description';
    }
}