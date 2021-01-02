<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function guests_users_can_not_create_statuses()
    {
        // $this->withoutExceptionHandling();

        // 1. Given => Tenienedo
        // No Teniendo un usuario no puede crear status

        // Para que laravel NO maneje las exepciones
        // $this->withoutExceptionHandling();
        
        // 2. When => Cuando
        // Cuando hace un post request a status
        $response = $this->post(route('statuses.store'), [
            'body' => 'Mi primer status'
        ]);

        //3. Then => Lo redirigimos al login
        $response->assertRedirect('login');
    }

    /** @test */  
    // public function un_usuario_puede_crear_estados()
    public function an_authenticated_user_can_create_statuses()
    {
        // Para que laravel NO maneje las exepciones
        // $this->withoutExceptionHandling();
        
        // 1. Given => Teniendo
        // Teniendo un usuario autenticado
        $user = User::factory()->create();
        
        $this->actingAs($user);

        // 2. When => Cuando
        // Cuando hace un post request a status
        $response = $this->postJson(route('statuses.store'), [
            'body' => 'Mi primer status'
        ]);

        $response->assertJson([
            'data' => ['body' => 'Mi primer status'],
        ]);
        
        // 3. Then => Entonces
        // Entonces veo un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'Mi primer status'
        ]);
    }

    /** @test */
    public function a_status_requires_a_body()
    {
        // Para que laravel NO maneje las exepciones
        // $this->withoutExceptionHandling();
        
        // 1. Given => Teniendo
        // Teniendo un usuario autenticado
        $user = User::factory()->create();
        $this->actingAs($user);

        // 2. When => Cuando
        // Cuando hace un post request a status y el campo body esta vacio
        $response = $this->postJson(route('statuses.store'), [
            'body' => ''
        ]);

        // 3. Then => Entonces
        // Entonces veo un mensaje de Error
        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
        
        $response->assertStatus(422);
    }

    /** @test */
    public function a_status_body_requires_a_minimum_length()
    {
        // Para que laravel NO maneje las exepciones
        // $this->withoutExceptionHandling();
        
        // 1. Given => Teniendo
        // Teniendo un usuario autenticado
        $user = User::factory()->create();
        $this->actingAs($user);

        // 2. When => Cuando
        // Cuando hace un post request a status y el campo body esta vacio
        $response = $this->postJson(route('statuses.store'), [
            'body' => 'gtrf'
        ]);

        // 3. Then => Entonces
        // Entonces veo un mensaje de Error
        $response->assertStatus(422);
        
        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }
}
