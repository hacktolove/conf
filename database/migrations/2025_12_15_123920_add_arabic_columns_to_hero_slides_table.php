<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('title');
            $table->string('subtitle_ar')->nullable()->after('subtitle');
            $table->text('description_ar')->nullable()->after('description');
            $table->string('button_text_ar')->nullable()->after('button_text');
            $table->string('button_text_2_ar')->nullable()->after('button_text_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'subtitle_ar', 'description_ar', 'button_text_ar', 'button_text_2_ar']);
        });
    }
};
