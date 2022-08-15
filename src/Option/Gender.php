<?php

namespace App\Option;

enum Gender: string {
    case Female = "female";
    case Male = "male";
    case Nonbinary = "non-binary";
    case Transgender = "transgender";
    case Secret = "secret";
    case Other = "other";
}