<?php

namespace App\Models;

use App\Enums\State;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Entry
 * @package App\Models
 * @property string $slug
 * @property string $uuid
 * @property string $delete_uuid
 * @property State $state
 * @property string $title
 * @property string $highlighter
 * @property string $password
 * @property string $content
 * @property DateTimeInterface $expires_at
 * @method static create(array $fields)
 */
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
        'title',
        'highlighter',
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
     * Entry constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $expires = $this->getAttribute("expires_at");

        if ($expires instanceof DateTimeInterface) {
            /** @var Carbon $expires */
            if ($expires->lessThanOrEqualTo(Carbon::now())) {
                $this->update([ "state" => State::Deleted() ]);
            }
        }
    }

    /**
     * @return string
     */
    public function getRouteKeyName() : string
    {
        return 'slug';
    }
}
