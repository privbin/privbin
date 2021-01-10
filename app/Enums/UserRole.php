<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static User()
 * @method static static Moderator()
 * @method static static Administrator()
 */
final class UserRole extends Enum
{
    const User          = 'user';
    const Moderator     = 'moderator';
    const Administrator = 'administrator';
}
