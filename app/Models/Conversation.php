<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Casts\DateTimeSplitCast;
use Illuminate\Support\Str;

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
}
