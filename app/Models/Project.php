<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_code',
        'project_type',
        'project_category',
        'sub_project_category',
    ];

    // Relationship with Documents
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    
}
