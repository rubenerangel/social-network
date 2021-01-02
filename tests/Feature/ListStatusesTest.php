<?php

namespace Tests\Feature;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Database\factories\StatusFactory;
use Tests\TestCase;

class ListStatusesTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_get_all_statuses()
    {
        // $this->withoutExceptionHandling();
        $statuses1 = Status::factory()->create(['created_at' => now()->subDays(4)]);
        $statuses2 = Status::factory()->create(['created_at' => now()->subDays(3)]);
        $statuses3 = Status::factory()->create(['created_at' => now()->subDays(2)]);
        $statuses4 = Status::factory()->create(['created_at' => now()->subDays(1)]);

        $response = $this->getJson(route('statuses.index'));

        $response->assertSuccessful();

        $response->assertJson([
            'meta' => ['total' => 4]
        ]);

        $response->assertJsonStructure([
            'data', 'links' => ['prev', 'next']
        ]);

        // dd($response->json('data'));

        $this->assertEquals(
            $statuses4->body,
            $response->json('data.0.body'),
        );
    }
}
