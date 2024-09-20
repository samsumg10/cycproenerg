<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installer extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type',
        'document_number',
        'name',
        'gas_registration',
        'phone'
    ];

    public function installations()
    {
        return $this->hasMany(Installation::class);
    }
}
