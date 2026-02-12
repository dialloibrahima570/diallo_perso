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
       Schema::create('user_settings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->boolean('notifications')->default(true);
    $table->json('notification_types')->nullable(); // ["cv","projects"]
    $table->boolean('dark_mode')->default(false);
    $table->string('theme_color')->default('#e63946');
    $table->string('language')->default('fr');
    $table->string('timezone')->default('UTC');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
