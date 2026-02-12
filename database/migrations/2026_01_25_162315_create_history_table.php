<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->string('action');          // accepté / refusé
            $table->string('email');           // email de la demande
            $table->unsignedBigInteger('request_item_id')->nullable(); // id de la demande
            $table->string('type')->nullable();    // cv / project
            $table->text('message')->nullable();   // message de la demande
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
