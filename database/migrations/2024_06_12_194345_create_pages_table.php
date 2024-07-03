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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable()->index();
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('video')->nullable();
            $table->string('type',100)->nullable();
            $table->string('template',100)->nullable();
            $table->mediumText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->json('image')->nullable();
            $table->json('banners')->nullable();
            $table->json('contents')->nullable();
            $table->json('options')->nullable();
            $table->json('buttons')->nullable();
            $table->json('sections')->nullable();
            $table->json('meta')->nullable();
            $table->boolean('featured')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
