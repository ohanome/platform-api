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
}