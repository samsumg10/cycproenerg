<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubicacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ubicaciones';

    protected $fillable = [
        'direccion',
        'departamento',
        'provincia',
        'distrito',
        'ubicacion',
        'codigo_manzana',
        'nombre_malla',
        'solicitante_id',
    ];

    // Relación con solicitante
    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }
}
