<?php

namespace App\Error;

class MethodMustBeGetError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 2101;
    }

    public static function getMessage(): string
    {
        return 'error.connection.method.must.be.get.message';
    }

    public static function getDescription(): string
    {
        return 'error.connection.method.must.be.get.description';
    }
}