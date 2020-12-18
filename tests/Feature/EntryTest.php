<?php

namespace Tests\Feature;

use App\Enums\EntryType;
use App\Enums\Expire;
use App\Enums\State;
use App\Models\Entry;
use Faker\Provider\Lorem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class EntryTest extends TestCase
{
    public function testStore()
    {
        for ($i = 100; $i > 0; $i--) {
            $response = $this->post('/store', [
                'expires' => Expire::getRandomValue(),
                'password' => rand(0, 1) == 0 ? Str::random() : null,
                'format' => EntryType::getRandomValue(),
                'content' => Lorem::paragraphs(60, true),
            ]);
            $response->assertStatus(302);
        }
    }

    public function testShow()
    {
        foreach (Entry::all() as $entry) {
            $response = $this->get('/s/'.$entry->uuid);
            $status = 200;
            if ($entry->state != State::Active()) $status = 404;
            $response->assertStatus($status);
        }
    }

    public function testRaw()
    {
        foreach (Entry::all() as $entry) {
            $response = $this->get('/s/'.$entry->uuid.'/raw');
            $status = 200;
            if (strlen($entry->password) > 0) $status = 403;
            if ($entry->state != State::Active()) $status = 404;
            $response->assertStatus($status);
        }
    }

    public function testDestroy()
    {
        foreach (Entry::all() as $entry) {
            $response = $this->delete('/d/'.$entry->uuid, [
                'token' => $entry->delete_uuid,
            ]);
            $response->assertStatus(302);
        }
    }
}
