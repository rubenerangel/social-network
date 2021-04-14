<?php

namespace Tests\Feature;

use App\Models\Friendship;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanRequestFriendshipTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function guest_users_cannot_create_friendship_request()
    {
        $recipient = User::factory()->create();

        $response = $this->postJson( route('friendships.store', $recipient) );

        $response->assertStatus(401);
        
    }

    /**
     * @test
     * @return void
     */
    public function guest_users_cannot_delete_friendship_request()
    {
        $recipient = User::factory()->create();

        $response = $this->deleteJson( route('friendships.destroy', $recipient) );

        $response->assertStatus(401);
        
    }

    /**
     * @test
     * @return void
     */
    public function guest_users_cannot_accept_friendship_request()
    {
        $user = User::factory()->create();

        $response = $this->postJson( route('accept-friendships.store', $user) );

        $response->assertStatus(401);
        
    }

    /**
     * @test
     * @return void
     */
    public function guest_users_cannot_deny_friendship_request()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson( route('accept-friendships.destroy', $user) );

        $response->assertStatus(401);
        
    }

    /**
     * @test
     * @return void
     */
    public function can_accept_friendship_request()
    {
        $this->withoutExceptionHandling();

        $sender = User::factory()->create();
        $recipient = User::factory()->create();

        Friendship::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);

        $this->actingAs($recipient)->postJson(route('accept-friendships.store', $sender));

        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'accepted'
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function can_send_friendship_request()
    {
        $this->withoutExceptionHandling();

        $sender = User::factory()->create();
        $recipient = User::factory()->create();

        $this->actingAs($sender)->postJson(route('friendships.store', $recipient));

        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);
    }

    /** @test */
    public function can_create_friendship_request()
    {
        $sender = User::factory()->create();
        $recipient = User::factory()->create();

        $this->actingAs($sender)->postJson(route('friendships.store', $recipient));

        

        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending'
        ]);

        $this->actingAs($sender)->postJson(route('friendships.store', $recipient));
        $this->assertCount(1, Friendship::all());
    }

    /**
     * @test
     * @return void
     */
    public function can_delete_friendship_request()
    {
        $this->withoutExceptionHandling();

        $sender = User::factory()->create();
        $recipient = User::factory()->create();

        Friendship::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);

        $this->actingAs($sender)->deleteJson(route('friendships.destroy', $recipient));

        $this->assertDatabaseMissing('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function can_deny_friendship_request()
    {
        $this->withoutExceptionHandling();

        $sender = User::factory()->create();
        $recipient = User::factory()->create();

        Friendship::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'pending',
        ]);

        $this->actingAs($recipient)->deleteJson(route('accept-friendships.destroy', $sender));

        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'status' => 'denied',
        ]);
    }
}
