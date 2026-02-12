<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('telecharger_cv', function (Blueprint $table) {
            // Status au lieu de approved
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('message');

            // Chemin du fichier CV
            $table->string('file_path')->nullable()->after('status');

            // On peut supprimer la colonne approved si on veut
            $table->dropColumn('approved');
        });
    }

    public function down(): void
    {
        Schema::table('telecharger_cv', function (Blueprint $table) {
            $table->boolean('approved')->default(false)->after('message');
            $table->dropColumn(['status', 'file_path']);
        });
    }
};
