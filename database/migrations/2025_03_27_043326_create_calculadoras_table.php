<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('calculadoras', function (Blueprint $table) {
            $table->id();
            
            // Datos personales (SIN COMENTARIOS PARA EVITAR TEXTO AZUL)
            $table->integer('edad')->nullable();
            $table->string('sexo', 1)->nullable();
            
            // Transporte
            $table->tinyInteger('medio_transporte')->nullable();
            $table->tinyInteger('tipo_combustible')->nullable();
            $table->decimal('km_automovil_dia', 8, 2)->nullable();
            $table->decimal('km_bicicleta_dia', 8, 2)->nullable();
            $table->tinyInteger('frecuencia_transporte_publico')->nullable();
            $table->integer('vuelos_anuales')->nullable();
            
            // Consumo energético
            $table->decimal('consumo_electricidad', 10, 2)->nullable();
            $table->tinyInteger('tipo_energia')->nullable();
            
            // Residuos
            $table->integer('bolsas_basura')->nullable();
            $table->decimal('porcentaje_reciclaje', 5, 2)->nullable();
            
            // Agua
            $table->decimal('consumo_agua', 10, 2)->nullable();
            
            // Resultados
            $table->decimal('resultado', 12, 2);
            $table->string('clasificacion', 10);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calculadoras');
    }
};