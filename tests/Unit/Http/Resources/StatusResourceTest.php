<?php

namespace Tests\Unit\Http\Resources;

use Tests\TestCase;
use App\Models\Status;
use Database\factories\StatusFactory;
use App\Http\Resources\StatusResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_status_resources_must_have_the_necessary_fields()
    {
        $this->withoutExceptionHandling();

        $status = Status::factory()->create();

        /* Transforma el estado y lo devuelve como queremos */
        $statusResource = StatusResource::make($status)->resolve();

        $this->assertEquals($status->body, $statusResource['body']);
        $this->assertEquals($status->user->name, $statusResource['user_name']);
        $this->assertEquals('https://aprendible.com/images/default-avatar.jpg', $statusResource['user_avatar']);
        // $this->assertEquals($status->created_at->diffForHumans(), $statusResource['created_at']);
        $this->assertEquals($status->created_at, $statusResource['created_at']);
    }
}
