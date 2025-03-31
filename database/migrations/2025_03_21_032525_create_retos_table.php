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
        Schema::create('retos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->unsignedTinyInteger('mes');
            $table->unsignedSmallInteger('año');
            $table->enum('dificultad', ['Fácil', 'Moderado', 'Difícil']);
            $table->string('icono'); // Nombre del icono de FontAwesome
            $table->text('beneficios')->nullable();
            $table->text('pasos_participacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retos');
    }
};
