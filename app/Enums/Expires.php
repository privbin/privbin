<?php

namespace App\Enums;

enum Expires: string
{
    case Forever = 'forever';
    case OneDay = '1day';
    case ThreeDays = '3days';
    case OneWeek = '1week';
    case TwoWeeks = '2weeks';
    case OneMonth = '1month';
    case SixMonths = '6months';
    case OneYear = '1year';
}
