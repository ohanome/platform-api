<?php

namespace App\Option;

enum EmploymentStatus: string {
    case FulltimeEmployed = "Fulltime employed";
    case ParttimeEmployed = "Part time employed";
    case Unemployed = "Unemployed";
    case School = "School";
    case Apprenticeship = "Apprenticeship";
    case Traineeship = "Traineeship";
    case Internship = "Internship";
    case Student = "Student";
    case Other = "Other";
}