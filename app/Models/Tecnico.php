<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tecnico extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tecnicos';

    protected $fillable = [
        'nombre',
        // 'numero_de_solicitud',
        // 'numero_de_documento',
    ];
}
