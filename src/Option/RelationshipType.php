<?php

namespace App\Option;

enum RelationshipType: string {
    case Monogamy = "Monogamy";
    case Polygamy = "Polygamy";
    case Polyamory = "Polyamory";
    case Other = "Other";
}