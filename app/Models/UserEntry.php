<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class UserEntry
 * @package App\Models
 * @method static create(array $fields)
 */
class UserEntry extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = "user_entries";

    /**
     * @var array $fillable
     */
    protected $fillable = [
        "user_id",
        "entry_id",
    ];

    /**
     * @return HasOne
     */
    public function user() : HasOne
    {
        return $this->hasOne(User::class, "id", "user_id");
    }

    /**
     * @return HasOne
     */
    public function entry() : HasOne
    {
        return $this->hasOne(Entry::class, "id", "entry_id");
    }
}
