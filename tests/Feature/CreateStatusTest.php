<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateStatusTest extends TestCase
{
    /** @test
     * Anotación para presindir de el prefijo test
     */
    public function un_usuario_puede_crear_estados()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
