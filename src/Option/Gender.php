<?php

namespace App\Option;

enum Gender: string {
    case Female = "female";
    case Male = "male";
    case Nonbinary = "non-binary";
    case Transgender = "transgender";
    case Secret = "secret";
    case Other = "other";

    public static function isValid(string $value): bool
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return true;
            }
        }

        return false;
    }
}