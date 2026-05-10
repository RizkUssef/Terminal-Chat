<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Casts\DateTimeSplitCast;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'password', 'user_name', 'user_key', 'last_seen_at', 'settings'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if (empty($user->user_key)) {
                $user->user_key = (string) Str::uuid();
            }
        });
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => DateTimeSplitCast::class,
            'last_seen_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function createConversation(): HasMany
    {
        return $this->hasMany(Conversation::class, 'creator_id');
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, "conversation_users")->using(ConversationUser::class)->withTimestamps();
    }

    public function conversationUsers(): HasMany
    {
        return $this->hasMany(ConversationUser::class, 'user_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function isOnline(): bool
    {
        return $this->last_seen_at > now()->subMinutes(2);
    }

    public function getConversationsWithPartners()
    {
        return $this->conversations()
            ->with(['users' => function ($q) {
                $q->where('conversation_users.user_id', '!=', $this->id);
            }])
            ->get();
    }
}
