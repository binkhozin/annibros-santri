<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('category', ['web', 'app', 'system']);
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('accent_color', 7)->nullable();
            $table->string('url')->nullable();
            $table->string('client_name')->nullable();
            $table->integer('year')->nullable();
            $table->json('technologies')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('slug');
            $table->index('category');
            $table->index('is_featured');
            $table->index('is_active');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
