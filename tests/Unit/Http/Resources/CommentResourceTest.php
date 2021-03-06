<?php

namespace Tests\Unit\Http\Resources;

use Tests\TestCase;
use App\Models\User;
use App\Models\Status;
use App\Http\Resources\UserResource;
use Database\factories\StatusFactory;
use App\Http\Resources\StatusResource;
use App\Http\Resources\CommentResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentResourceTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_comment_resources_must_have_the_necessary_fields()
    {
        $this->withoutExceptionHandling();

        $comment = Status::factory()->create();

        /* Transforma el estado y lo devuelve como queremos */
        $CommentResource = CommentResource::make($comment)->resolve();

        $this->assertEquals(
            $comment->id, 
            $CommentResource['id']
        );

        /* $this->assertEquals(
            $comment->user->name, 
            $CommentResource['user_name']
        ); */

        $this->assertEquals(
            $comment->body, 
            $CommentResource['body']
        );

        /* $this->assertEquals(
            $comment->user->link(), 
            $CommentResource['user_link']
        ); */

        /* $this->assertEquals(
            $comment->user->avatar(), 
            $CommentResource['user_avatar']
        ); */

        $this->assertEquals(
            0, 
            $CommentResource['likes_count']
        );

        $this->assertEquals(
            false, 
            $CommentResource['is_liked']
        );

        $this->assertInstanceOf (
           UserResource::class,
            $CommentResource['user']
        );

        $this->assertInstanceOf(
            User::class,
            $CommentResource['user']->resource
        );
    }
}
