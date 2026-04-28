<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Casts\DateTimeSplitCast;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;


#[Fillable(['conversation_id', 'sender_id', 'message', 'status'])]
class Message extends Model
{
    use HasFactory;
    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
            'created_at' => DateTimeSplitCast::class,
            'updated_at' => DateTimeSplitCast::class,
        ];
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Scope: unread messages for the auth user
    public function scopeUnread(Builder $query): Builder
    {
        return $query
            ->whereNull('read_at')
            ->where('sender_id', '!=', auth()->id()); // don't count your own messages
    }

    public function isRead(): bool
    {
        return !is_null($this->read_at);
    }
}
