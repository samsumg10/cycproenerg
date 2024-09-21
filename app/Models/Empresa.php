<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'empresas';

    protected $fillable = [
        'tipo_documento_identificacion',
        'numero_documento_identificacion',
        'nombre',
        'registro_gas_natural',
        'solicitante_id',
    ];

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }
}
