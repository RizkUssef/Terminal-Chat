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

#[Fillable(['name', 'email', 'password', 'user_name', 'user_key'])]
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
            'password' => 'hashed',
        ];
    }

    public function conversationUser(): HasMany
    {
        return $this->hasMany(ConversationUser::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
