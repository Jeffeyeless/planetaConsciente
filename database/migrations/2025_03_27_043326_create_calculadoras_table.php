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
            
            // Datos personales
            $table->integer('edad')->nullable();
            $table->string('sexo', 1)->nullable()->comment('M: Masculino, F: Femenino, O: Otro');
            
            // Transporte
            $table->tinyInteger('medio_transporte')->nullable()->comment('0: No tiene, 1: Automóvil, 2: Bicicleta, 3: Transporte público, 4: Caminando');
            $table->tinyInteger('tipo_combustible')->nullable()->comment('0: No aplica, 1: Gasolina, 2: Diésel, 3: Eléctrico, 4: Híbrido');
            $table->decimal('km_automovil_dia', 8, 2)->nullable();
            $table->decimal('km_bicicleta_dia', 8, 2)->nullable();
            $table->tinyInteger('frecuencia_transporte_publico')->nullable()->comment('1: Diariamente, 2: Varias veces/semana, 3: Ocasionalmente, 4: Casi nunca, 5: Nunca');
            $table->integer('vuelos_anuales')->nullable();
            
            // Consumo energético
            $table->decimal('consumo_electricidad', 10, 2)->nullable();
            $table->tinyInteger('tipo_energia')->nullable()->comment('1: Renovable, 2: No renovable, 3: No estoy seguro');
            
            // Residuos
            $table->integer('bolsas_basura')->nullable();
            $table->decimal('porcentaje_reciclaje', 5, 2)->nullable();
            
            // Agua
            $table->decimal('consumo_agua', 10, 2)->nullable();
            
            // Resultados
            $table->decimal('resultado', 12, 2)->comment('Huella de carbono calculada');
            $table->string('clasificacion', 10)->comment('Baja/Media/Alta');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calculadoras');
    }
};