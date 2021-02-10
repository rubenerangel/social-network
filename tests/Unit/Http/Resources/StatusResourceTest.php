<?php

namespace Tests\Unit\Http\Resources;

use Tests\TestCase;
use App\Models\User;
use App\Models\Status;
use App\Models\Comment;
use App\Http\Resources\UserResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\CommentResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_status_resources_must_have_the_necessary_fields()
    {
        $this->withoutExceptionHandling();

        $status = Status::factory()->create();
        Comment::factory()->create(['status_id' => $status->id]);

        /* Transforma el estado y lo devuelve como queremos */
        $statusResource = StatusResource::make($status)->resolve();

        $this->assertEquals(
            $status->id, 
            $statusResource['id']
        );

        $this->assertEquals(
            $status->body, 
            $statusResource['body']
        );

        /* $this->assertEquals(
            $status->user->link(), 
            $statusResource['user_link']
        ); */

        /* $this->assertEquals(
            $status->user->name, 
            $statusResource['user_name']
        ); */

        /* $this->assertEquals(
            $status->user->avatar(), 
            $statusResource['user_avatar']
        ); */

        $this->assertEquals(
            $status->created_at, 
            $statusResource['created_at']
        );

        $this->assertEquals(
            false, 
            $statusResource['is_liked']
        );

        $this->assertEquals(
            0,
            $statusResource['likes_count']
        );

        $this->assertEquals(
           CommentResource::class,
            $statusResource['comments']->collects
        );

        $this->assertInstanceOf(
            Comment::class,
            $statusResource['comments']->first()->resource
        );

        $this->assertInstanceOf (
           UserResource::class,
            $statusResource['user']
        );

        $this->assertInstanceOf(
            User::class,
            $statusResource['user']->resource
        );
    }
}
