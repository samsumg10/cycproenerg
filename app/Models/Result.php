<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'tc_result',
        'connection_result',
        'external_installation_result',
        'rejected', // Nuevo campo
        'cancelled', // Nuevo campo
        'cancellation_reason', // Nuevo campo
        'observed_for_installer', // Nuevo campo
        'observed_for_concessionaire', // Nuevo campo
        'enabled', // Nuevo campo
        'test_date', // Nuevo campo
        'attempt_number' // Nuevo campo
    ];

    // Relationship with Document
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
