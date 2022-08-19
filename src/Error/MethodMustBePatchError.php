<?php

namespace App\Error;

class MethodMustBePatchError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 2103;
    }

    public static function getMessage(): string
    {
        return 'error.connection.method.must.be.patch.message';
    }

    public static function getDescription(): string
    {
        return 'error.connection.method.must.be.patch.description';
    }
}