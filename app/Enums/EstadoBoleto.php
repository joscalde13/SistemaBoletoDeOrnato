<?php

namespace App\Enums;

/**
 * Estados posibles de un boleto de ornato.
 */
enum EstadoBoleto: string
{
    case Pendiente = 'pendiente';
    case Pagado = 'pagado';
    case Anulado = 'anulado';

    /**
     * Obtener etiqueta legible para la UI.
     */
    public function etiqueta(): string
    {
        return match ($this) {
            self::Pendiente => 'Pendiente',
            self::Pagado => 'Pagado',
            self::Anulado => 'Anulado',
        };
    }

    /**
     * Obtener clase CSS para badges.
     */
    public function claseCss(): string
    {
        return match ($this) {
            self::Pendiente => 'bg-yellow-100 text-yellow-800',
            self::Pagado => 'bg-green-100 text-green-800',
            self::Anulado => 'bg-red-100 text-red-800',
        };
    }
}
