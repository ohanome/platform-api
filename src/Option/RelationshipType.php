<?php

namespace App\Option;

enum RelationshipType: string {
    case Monogamy = "Monogamy";
    case Polygamy = "Polygamy";
    case Polyamory = "Polyamory";
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