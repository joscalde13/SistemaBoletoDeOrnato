<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Configuración de datos municipales.
     * Solo existirá un registro (patrón singleton).
     */
    public function up(): void
    {
        Schema::create('configuracion_municipal', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_municipalidad', 255);
            $table->string('municipio', 100);
            $table->string('departamento', 100);
            $table->text('direccion');
            $table->string('telefono', 20);
            $table->string('email', 150)->nullable();
            $table->string('sitio_web', 255)->nullable();
            $table->string('alcalde', 200);
            $table->string('logo_path', 500)->nullable();
            $table->integer('anio_fiscal_actual');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion_municipal');
    }
};
