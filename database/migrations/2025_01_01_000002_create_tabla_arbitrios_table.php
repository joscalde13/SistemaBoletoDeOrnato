<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de arbitrios - rangos de ingresos y montos según Decreto 121-96.
     * Configurable desde el panel administrativo.
     */
    public function up(): void
    {
        Schema::create('tabla_arbitrios', function (Blueprint $table) {
            $table->id();
            $table->decimal('rango_inicio', 10, 2)->comment('Inicio del rango de ingresos mensuales en Quetzales');
            $table->decimal('rango_fin', 10, 2)->comment('Fin del rango de ingresos mensuales en Quetzales');
            $table->decimal('monto', 10, 2)->comment('Monto del arbitrio de ornato en Quetzales');
            $table->string('descripcion', 255)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tabla_arbitrios');
    }
};
