<?php

namespace App\Error;

class AccountNotActivatedError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1101;
    }

    public static function getMessage(): string
    {
        return 'error.user.you.account.not_activated.message';
    }

    public static function getDescription(): string
    {
        return 'error.user.you.account.not_activated.description';
    }
}