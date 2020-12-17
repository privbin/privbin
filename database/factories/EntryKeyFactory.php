<?php

namespace Database\Factories;

use App\Models\Entry;
use App\Models\EntryKey;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EntryKeyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EntryKey::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'entry_id' => Entry::factory(),
            'read' => rand(0, 1) == 0,
            'destroy' => rand(0, 1) == 0,
            'key' => Str::random(),
        ];
    }
}
