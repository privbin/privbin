<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'sessions';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'uuid',
        'ip_address',
        'user_agent',
        'last_activity',
    ];

    /**
     * @var array $casts
     */
    protected $casts = [

    ];

    /**
     * @var string[] $dates
     */
    protected $dates = [
        'last_activity',
    ];
}
