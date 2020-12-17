<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PlainText()
 * @method static static Markdown()
 */
final class EntryType extends Enum
{
    const PlainText = 'plain_text';
    const Markdown  = 'markdown';
}
