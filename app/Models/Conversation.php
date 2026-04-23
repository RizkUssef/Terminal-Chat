<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Casts\DateTimeSplitCast;

#[Fillable(['conversation_key'])]
class Conversation extends Model
{
    protected function casts(): array
    {
        return [
            'created_at' => DateTimeSplitCast::class,
            'updated_at' => DateTimeSplitCast::class,
        ];
    }
}
