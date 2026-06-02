<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de boletos de ornato emitidos.
     * Cada boleto está vinculado a un contribuyente y tiene un código QR único.
     */
    public function up(): void
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_boleto', 20)->unique()->index()->comment('Formato: BO-YYYY-XXXXX');
            $table->string('codigo_verificacion', 36)->unique()->index()->comment('UUID para verificación QR');
            $table->foreignId('contribuyente_id')->constrained('contribuyentes')->restrictOnDelete();
            $table->integer('anio_fiscal')->index();
            $table->decimal('monto', 10, 2);
            $table->string('estado', 20)->default('pendiente')->index()->comment('pendiente, pagado, anulado');
            $table->dateTime('fecha_emision');
            $table->dateTime('fecha_pago')->nullable();
            $table->string('metodo_pago', 50)->nullable()->comment('efectivo, tarjeta, transferencia');
            $table->string('referencia_pago', 100)->nullable();
            $table->text('observaciones')->nullable();
            $table->foreignId('emitido_por')->nullable()->constrained('users')->nullOnDelete()->comment('NULL = autoservicio público');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boletos');
    }
};
