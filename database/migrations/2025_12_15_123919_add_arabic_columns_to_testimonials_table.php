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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('name');
            $table->string('title_ar')->nullable()->after('title');
            $table->string('company_ar')->nullable()->after('company');
            $table->text('content_ar')->nullable()->after('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['name_ar', 'title_ar', 'company_ar', 'content_ar']);
        });
    }
};
