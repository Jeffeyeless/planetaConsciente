<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id('id_noticia'); 
            $table->string('titulo', 255);
            $table->string('resumen', 500);
            $table->text('contenido');
            $table->date('fecha_publicacion');
            $table->string('fuente', 100)->nullable();
            $table->string('imagen_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('noticias');
    }
};