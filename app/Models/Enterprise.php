<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_type',
        'document_number',
        'name',
        'natural_gas_registration',
    ];

        // Relationship with Documents (Concessionaire)
        public function documents()
        {
            return $this->hasMany(Document::class, 'enterprises_id');
        }
}
