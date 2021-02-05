<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\CommentResource;
use Tests\TestCase;
use App\Models\Status;
use Database\factories\StatusFactory;
use App\Http\Resources\StatusResource;
use App\Models\Comment;
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
        $this->assertEquals(
            $status->user->name, 
            $statusResource['user_name']
        );
        $this->assertEquals(
            'https://aprendible.com/images/default-avatar.jpg', 
            $statusResource['user_avatar']
        );
        // $this->assertEquals($status->created_at->diffForHumans(), $statusResource['created_at']);
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
// dd($statusResource['comments']->collection->first()->resource);
        $this->assertEquals(
           CommentResource::class,
            $statusResource['comments']->collects
        );

        $this->assertInstanceOf(
            Comment::class,
            $statusResource['comments']->first()->resource
        );
    }
}
