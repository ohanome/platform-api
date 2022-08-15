<?php

namespace App\Option;

enum RelationshipStatus: string {
    case Single = "Single";
    case Relationship = "In a relationship";
    case Married = "Married";
    case Complicated = "It's complicated";
    case Divorced = "Divorced";
    case Widowed = "Widowed";
    case OpenRelationship = "In an open relationship";
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