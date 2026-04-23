<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Casts\DateTimeSplitCast;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


#[Fillable(['conversation_id', 'sender_id', 'message', 'status'])]
class Message extends Model
{
    protected function casts(): array
    {
        return [
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
}
