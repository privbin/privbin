<?php

namespace App\Models;

use App\Enums\Expires;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Paste extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'title',
        'language',
        'expires',
        'password',
        'content',
    ];

    protected $casts = [
        'expires' => Expires::class,
    ];

    protected $hidden = [
        'password',
    ];

    public function isProtected(): bool
    {
        return $this->password !== null;
    }

    public function isPasswordValid(string $password): bool
    {
        return $password === $this->password || Hash::check($password, $this->password);
    }

    public function isExpired(): bool
    {
        if ($this->expires === null || $this->expires === Expires::Forever) {
            return false;
        }

        $createdAt = $this->asDateTime($this->created_at);
        return match ($this->expires) {
            Expires::Forever => false,
            Expires::OneDay => $createdAt->addDay()->isPast(),
            Expires::OneWeek => $createdAt->addWeek()->isPast(),
            Expires::TwoWeeks => $createdAt->addWeeks(2)->isPast(),
            Expires::OneMonth => $createdAt->addMonth()->isPast(),
            Expires::SixMonths => $createdAt->addMonths(6)->isPast(),
            Expires::OneYear => $createdAt->addYear()->isPast(),
            Expires::ThreeDays => $createdAt->addDays(3)->isPast(),
            default => true,
        };
    }
}
