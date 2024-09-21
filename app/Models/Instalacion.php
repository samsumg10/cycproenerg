<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instalacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'instalaciones';

    protected $fillable = [
        'tipo',
        'tipo_acometida',
        'material',
        'numero_puntos_proyectados',
        'numero_puntos_instalados',
        'numero_puntos_habilitados',
        'ambientes_aprobados',
        'numero_ambientes',
        'solicitante_id',
    ];

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }
}
