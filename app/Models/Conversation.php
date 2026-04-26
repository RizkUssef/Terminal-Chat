<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Casts\DateTimeSplitCast;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['conversation_key'])]
class Conversation extends Model
{
    protected static function booted(): void
    {
        static::creating(function (Conversation $conversation) {
            if (empty($conversation->conversation_key)) {
                $conversation->conversation_key = (string) Str::uuid();
            }
        });
    }
    protected function casts(): array
    {
        return [
            'created_at' => DateTimeSplitCast::class,
            'updated_at' => DateTimeSplitCast::class,
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "conversation_users")->using(ConversationUser::class)->withTimestamps();
    }
    public function conversationUsers(): HasMany
    {
        return $this->hasMany(ConversationUser::class, 'conversation_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    // scopes 
    // local scope to get conversations between two users
    public function scopePrivateBetween($query, int $creator_id, int $user_id)
    {
        return $query->whereHas('users', fn($q) => $q->where('user_id', $creator_id))
            ->whereHas('users', fn($q) => $q->where('user_id', $user_id));
    }
}
