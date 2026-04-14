<?php

namespace App\Models;

// This is the User model - represents a person who uses the app
// Each user can have many habits and habit logs

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Use this trait to create users in tests
    use HasFactory;

    // Fields that can be filled when creating a user
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar_url',
    ];

    // Fields that are hidden when returning user data
    protected $hidden = ['password'];

    /**
     * Cast attributes to their proper types.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relationship: A user can have many habits
    public function habits(): HasMany
    {
        return $this->hasMany(Habit::class);
    }

    // Relationship: A user can have many habit logs (records of completed habits)
    public function habitLogs(): HasMany
    {
        return $this->hasMany(HabitLog::class);
    }
}
