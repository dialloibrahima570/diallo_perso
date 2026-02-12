<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); // ex : Développeur Laravel
            $table->text('description'); // résumé du CV
            $table->string('fichier_cv')->nullable(); // PDF si tu veux
            $table->boolean('visible')->default(false); // sécurité
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
