<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    use HasFactory;
    protected $fillable = [
        'installation_type',
        'connection_type',
        'installation_material',
        'installation_points_number',
        'start_date',
        'end_date',
        'total_length',
        'inspector_id',
        'scheduled_internal_installation_date', // Nuevo campo
        'internal_installation_start_date', // Nuevo campo
        'internal_installation_end_date', // Nuevo campo
        'acometida_installation_end_date', // Nuevo campo
        'scheduled_habilitation_date', // Nuevo campo
        'document_submission_date', // Nuevo campo
        'valve_approved', // Nuevo campo
        'nominal_valve_diameter' // Nuevo campo
    ];
    // Relationship with Inspector
    public function inspector()
    {
        return $this->belongsTo(Inspector::class);
    }

    // Relationship with Documents
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
