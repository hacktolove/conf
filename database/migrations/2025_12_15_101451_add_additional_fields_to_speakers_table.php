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
        Schema::table('speakers', function (Blueprint $table) {
            $table->string('email')->nullable()->after('company');
            $table->string('phone')->nullable()->after('email');
            $table->string('experience')->nullable()->after('phone');
            $table->string('website')->nullable()->after('instagram');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('speakers', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone', 'experience', 'website']);
        });
    }
};
