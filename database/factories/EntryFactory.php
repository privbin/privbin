<?php

namespace Database\Factories;

use App\Enums\EntryType;
use App\Enums\State;
use App\Models\Entry;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'state' => State::getRandomValue(),
            'type' => EntryType::getRandomValue(),
            'password' => rand(0, 1) ? Hash::make('password') : null,
            'content' => $this->faker->text,
            'expires_at' => Carbon::make('+'.rand(0, 59).' minutes'),
        ];
    }
}
