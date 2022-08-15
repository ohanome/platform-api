<?php

namespace App\Option;

enum Sexuality: string {
    case Heterosexual = "Heterosexual";
    case Homosexual = "Homosexual";
    case Bisexual = "Bisexual";
    case Pansexual = "Pansexual";
    case Omnisexual = "Omnisexual";
    case Asexual = "Asexual";
    case Secret = "Secret";
    case Other = "Other";

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