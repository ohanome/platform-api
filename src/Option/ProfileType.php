<?php

namespace App\Option;

enum ProfileType: string {
    case Personal = "personal";
    case Company = "company";
    case Artist = "artist";
    case Musician = "musician";
    case Influencer = "influencer";
    case Streamer = "streamer";

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