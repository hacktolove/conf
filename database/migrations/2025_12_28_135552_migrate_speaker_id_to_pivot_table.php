<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate existing speaker_id data to pivot table
        $schedules = DB::table('schedules')
            ->whereNotNull('speaker_id')
            ->get();

        foreach ($schedules as $schedule) {
            DB::table('schedule_speaker')->insert([
                'schedule_id' => $schedule->id,
                'speaker_id' => $schedule->speaker_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is not reversible as we can't determine which speaker_id
        // was the original one if multiple speakers exist
        // The speaker_id column will remain nullable for backward compatibility
    }
};
