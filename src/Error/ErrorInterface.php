<?php

namespace App\Error;

interface ErrorInterface
{
    /**
     * @return int The error code
     */
    public static function getCode(): int;

    /**
     * @return string The error message key used for translations
     */
    public static function getMessage(): string;

    /**
     * @return string The error description key used for translations
     */
    public static function getDescription(): string;
}