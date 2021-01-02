<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Like;
use App\Models\User;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;


class StatusTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_status_belongs_to_a_user()
    {
        $status = Status::factory()->create();

        $this->assertInstanceOf(User::class, $status->user);
    }

    /** @test */
    public function a_status_has_many_likes()
    {
        $this->withoutExceptionHandling();

        $status = Status::factory()->create();

        Like::factory()->create([
            'status_id' => $status->id
        ]);

        $this->assertInstanceOf(Like::class, $status->likes->first() );
    }

    /** @test */
    public function a_status_can_be_like()
    {
        $status = Status::factory()->create();

        $this->actingAs( User::factory()->create() );

        $status->like();

        $this->assertEquals(1, $status->likes->count());
    }

    /** @test */
    public function a_status_can_be_liked_once()
    {
        $status = Status::factory()->create();

        $this->actingAs( User::factory()->create() );

        $status->like();

        $this->assertEquals(1, $status->likes->count());

        $status->like();

        $this->assertEquals(1, $status->fresh()->likes->count());
    }
}
