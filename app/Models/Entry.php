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
        'slug',
        'uuid',
        'delete_uuid',
        'state',
        'compiler',
        'password',
        'content',
        'expires_at',
    ];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'state' => State::class,
    ];

    /**
     * @var string[] $dates
     */
    protected $dates = [
        'expires_at',
    ];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
