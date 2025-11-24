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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group', 100);
            $table->string('key', 150)->unique();
            $table->string('label', 255)->nullable();
            $table->text('value')->nullable();
            $table->enum('type', [
                'text',
                'textarea',
                'number',
                'boolean',
                'select',
                'json',
                'file',
                'image',
                'email',
                'url'
            ])->default('text');
            $table->string('min', 50)->nullable();
            $table->string('max', 50)->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
