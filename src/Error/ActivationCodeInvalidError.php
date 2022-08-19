<?php

namespace App\Error;

class ActivationCodeInvalidError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1103;
    }

    public static function getMessage(): string
    {
        return 'error.user.activation.code.invalid.message';
    }

    public static function getDescription(): string
    {
        return 'error.user.activation.code.invalid.description';
    }
}