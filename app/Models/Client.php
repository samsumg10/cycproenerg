<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_type',
        'document_number',
        'name',
        'phone',
        'cell_phone',
        'email',
        'address',
        'department',
        'province',
        'district',
        'has_property_document',
        'fise_user',
    ];

    // Relationship with Documents
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
