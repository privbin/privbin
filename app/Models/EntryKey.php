<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EntryKey extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'entry_keys';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'entry_id',
        'read',
        'destroy',
        'key',
    ];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'read' => 'boolean',
        'destroy' => 'boolean',
    ];

    /**
     * @return HasOne
     */
    public function entry(): HasOne
    {
        return $this->hasOne(Entry::class, 'id', 'entry_id');
    }
}
