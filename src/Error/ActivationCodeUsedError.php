<?php

namespace App\Error;

class ActivationCodeUsedError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1105;
    }

    public static function getMessage(): string
    {
        return 'error.user.activation.code.used.message';
    }

    public static function getDescription(): string
    {
        return 'error.user.activation.code.used.description';
    }
}