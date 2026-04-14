<?php

namespace App\Models;

// This is the HabitLog model - represents a single completion record of a habit
// Each log belongs to a user and a habit

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HabitLog extends Model
{
    // Use this trait to create logs in tests
    use HasFactory;

    // Fields that can be filled when creating a log
    protected $fillable = [
        'user_id',
        'habit_id',
        'completed_at',
    ];

    // Relationship: Get the user who completed this log
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Get the habit this log is for
    public function habit(): BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }
}
