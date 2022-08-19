<?php

namespace App\Error;

class MethodMustBePostError implements ErrorInterface
{
    public static function getCode(): int
    {
        return 2102;
    }

    public static function getMessage(): string
    {
        return 'error.connection.method.must.be.post.message';
    }

    public static function getDescription(): string
    {
        return 'error.connection.method.must.be.post.description';
    }
}