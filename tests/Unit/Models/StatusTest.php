<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
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
    public function a_status_has_many_comments()
    {
        $this->withoutExceptionHandling();

        $status = Status::factory()->create();

        Comment::factory()->create([
            'status_id' => $status->id
        ]);

        $this->assertInstanceOf(Comment::class, $status->comments->first() );
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
    public function a_status_can_be_like_and_unlike()
    {
        $status = Status::factory()->create();

        $this->actingAs( User::factory()->create() );

        $status->like();

        $this->assertEquals(1, $status->fresh()->likes->count());

        $status->unlike();

        $this->assertEquals(0, $status->fresh()->likes->count());
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

    /** @test */
    public function a_status_knows_if_it_has_been_liked()
    {
        $status = Status::factory()->create();

        $this->assertFalse($status->isLiked());
        
        $this->actingAs(User::factory()->create());
        
        $this->assertFalse($status->isLiked());

        $status->like();

        $this->assertTrue($status->isLiked());
    }

    /** @test */
    public function a_status_knows_how_many_likes_it_has()
    {
        $status = Status::factory()->create();

        $this->assertEquals(0, $status->likesCount());
        
        Like::factory()->times(2)->create([
            'status_id' => $status->id
        ]);

        $this->assertEquals(2, $status->likesCount());
    }
}
