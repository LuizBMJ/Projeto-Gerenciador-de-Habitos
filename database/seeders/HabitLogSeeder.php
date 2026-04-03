<?php

namespace Database\Seeders;

use App\Models\HabitLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::where('email', 'jorge@gmail.com')->firstOrFail();
        $habits = \App\Models\Habit::where('user_id', $user->id)->get();

        foreach ($habits as $habit) {
            $usedDates = [];
            $count = rand(5, 15);
            $attempts = 0;

            while (count($usedDates) < $count && $attempts < 100) {
                $date = \Carbon\Carbon::now()
                    ->subDays(rand(0, 365))
                    ->toDateString();

                if (!in_array($date, $usedDates)) {
                    $usedDates[] = $date;

                    \App\Models\HabitLog::create([
                        'user_id'      => $user->id,
                        'habit_id'     => $habit->id,
                        'completed_at' => $date,
                    ]);
                }

                $attempts++;
            }
        }
    }
}