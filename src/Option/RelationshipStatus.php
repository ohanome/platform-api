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
}