<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_type',
        'document_number',
        'name',
        'cell_phone',
    ];

    // Relationship with Installations
    public function installations()
    {
        return $this->hasMany(Installation::class);
    }
}
