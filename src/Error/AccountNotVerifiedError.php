<?php

namespace App\Error;

class AccountNotVerifiedError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 1102;
    }

    public static function getMessage(): string
    {
        return 'error.user.you.account.not_verified.message';
    }

    public static function getDescription(): string
    {
        return 'error.user.you.account.not_verified.description';
    }
}