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
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->string('numeroCompte')->unique();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['epargne', 'cheque']);
            $table->string('devise');
            $table->date('dateCreation');
            $table->enum('statut', ['actif', 'bloque', 'ferme']);
            $table->dateTime('derniereModification')->nullable();
            $table->integer('version')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
