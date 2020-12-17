<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Active()
 * @method static static Passive()
 * @method static static Deleted()
 */
final class State extends Enum
{
    const Active    = 'active';
    const Passive   = 'passive';
    const Deleted   = 'deleted';
}
