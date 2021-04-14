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
    public function can_accept_friendship_request()
    {
        $this->withoutExceptionHandling();

        $sender = User::factory()->create();
        $recipient = User::factory()->create();

        Friendship::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'accepted' => false
        ]);

        $this->actingAs($recipient)->postJson(route('request-friendships.store', $sender));

        $this->assertDatabaseHas('friendships', [
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'accepted' => true
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
            'accepted' => false
        ]);
    }
}
