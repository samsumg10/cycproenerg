<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prueba extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pruebas';

    protected $fillable = [
        'fecha_realizacion',
        'nro_intento',
        'hermeticidad_aprobada',
        'presion_operacion_hermeticidad_mbar',
        'presion_inicial_prueba_hermeticidad_mbar',
        'presion_final_prueba_hermeticidad_mbar',
        'tiempo_prueba_hermeticidad_min',
        'presion_artefacto_aprobada',
        'presion_artefacto_mbar',
        'prueba_monoxido_aprobada',
        'solicitante_id',
    ];

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }
}
