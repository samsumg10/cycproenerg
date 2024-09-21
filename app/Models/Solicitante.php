<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitante extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'solicitantes';

    protected $fillable = [
        'tipo_documento_identificacion',
        'numero_documento_identificacion',
        'nombre',
        'telefono',
        'celular',
        'correo_electronico',
    ];

    // Relación con Solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    // Relación con Ubicaciones
    public function ubicaciones()
    {
        return $this->hasMany(Ubicacion::class);
    }

    // Relación con Proyectos
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

    // Relación con Empresas
    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }

    // Relación con Instalaciones
    public function instalaciones()
    {
        return $this->hasMany(Instalacion::class);
    }

    // Relación con Pruebas
    public function pruebas()
    {
        return $this->hasMany(Prueba::class);
    }

}
