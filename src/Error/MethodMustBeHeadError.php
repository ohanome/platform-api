<?php

namespace App\Error;

class MethodMustBeHeadError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 2105;
    }

    public static function getMessage(): string
    {
        return 'error.connection.method.must.be.head.message';
    }

    public static function getDescription(): string
    {
        return 'error.connection.method.must.be.head.description';
    }
}