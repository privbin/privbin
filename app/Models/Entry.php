<?php

namespace App\Models;

use App\Enums\EntryType;
use App\Enums\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entry extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'entries';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'state',
        'type',
        'password',
        'content',
        'expires_at',
    ];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'state' => State::class,
        'type' => EntryType::class,
    ];

    /**
     * @return HasMany
     */
    public function keys(): HasMany
    {
        return $this->hasMany(EntryKey::class, 'entry_id', 'id');
    }
}
