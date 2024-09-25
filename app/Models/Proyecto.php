<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'proyectos';

    protected $fillable = [
        'tipo_proyecto',
        'codigo_proyecto',
        'categoria',
        'sub_categoria',
        'codigo_objeto_conexion',
        'solicitante_id',
    ];

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }
}
