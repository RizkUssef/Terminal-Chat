<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $conversation = Conversation::with('users')->inRandomOrder()->first();
        $senderId = $conversation->users->random()->id;
        return [
            'conversation_id' => $conversation->id,
            'sender_id' => $senderId,
            'message' => fake()->text(random_int(10, 100)),
        ];
    }
}
