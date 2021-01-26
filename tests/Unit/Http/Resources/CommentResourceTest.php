<?php

namespace Tests\Unit\Http\Resources;

use Tests\TestCase;
use App\Models\Status;
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
            $comment->body, 
            $CommentResource['body']
        );
    }
}
