<?php

namespace App\Error;

class MethodMustBeDeleteError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 2104;
    }

    public static function getMessage(): string
    {
        return 'error.connection.method.must.be.delete.message';
    }

    public static function getDescription(): string
    {
        return 'error.connection.method.must.be.delete.description';
    }
}