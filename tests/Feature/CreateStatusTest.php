<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;
    /** 
     * @test
     * Anotación para presindir de el prefijo test
     */

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

    // public function un_usuario_puede_crear_estados()
    public function an_authenticated_user_can_create_statuses()
    {
        // Para que laravel NO maneje las exepciones
        $this->withoutExceptionHandling();
        
        // 1. Given => Tenienedo
        // Teniendo un usuario autenticado
        $user = User::factory()->make();
        
        $this->actingAs($user);

        // 2. When => Cuando
        // Cuando hace un post request a status
        $response = $this->post(route('statuses.store'), [
            'body' => 'Mi primer status'
        ]);

        $response->assertJson([
            'body' => 'Mi primer status'
        ]);
        
        // 3. Then => Entonces
        // Entonces veo un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'Mi primer status'
        ]);
    }
}
