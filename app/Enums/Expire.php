<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Minute5()
 * @method static static Minute15()
 * @method static static Minute30()
 * @method static static Hour1()
 * @method static static Hour3()
 * @method static static Hour6()
 * @method static static Day1()
 */
final class Expire extends Enum
{
    const Minute5   = 'minute_5';
    const Minute15  = 'minute_15';
    const Minute30  = 'minute_30';
    const Hour1     = 'hour_1';
    const Hour3     = 'hour_3';
    const Hour6     = 'hour_6';
    const Day1      = 'day_1';
}
