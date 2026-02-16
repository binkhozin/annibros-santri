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
        Schema::table('articles', function (Blueprint $table) {
            $table->string('arabic_title')->nullable()->after('title');
            $table->string('category')->nullable()->after('slug');
            $table->json('tags')->nullable()->after('content');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['arabic_title', 'category', 'tags']);
        });
    }
};
