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
        Schema::create('calculadoras', function (Blueprint $table) {
            $table->id('id_calculadora');
            $table->float('resultado');
            $table->enum('clasificacion', ['Baja', 'Media', 'Alta']);
            $table->json('detalles')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculadoras');
    }
};
