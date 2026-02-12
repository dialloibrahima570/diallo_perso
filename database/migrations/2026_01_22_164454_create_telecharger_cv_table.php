<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('telecharger_cv', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('message')->nullable();
            $table->boolean('approved')->default(false); // pour gérer l'accès
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telecharger_cv');
    }
};
