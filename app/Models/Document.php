<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_number',
        'client_id',
        'installation_id',
        'enterprises_id',
        'project_id',
        'approval_registration_date',
        'contract_approval_date',
        'internal_property_code', // Nuevo campo
        'supply_number', // Nuevo campo
        'supply_contract_number' // Nuevo campo
    ];

        // Relationship with Client
        public function client()
        {
            return $this->belongsTo(Client::class);
        }
    
        // Relationship with Installation
        public function installation()
        {
            return $this->belongsTo(Installation::class);
        }
    
        // Relationship with Contractor (Concessionaire)
        public function concessionaireContractor()
        {
            return $this->belongsTo(Enterprise::class,'enterprises_id');
        }
    
        // Relationship with Project
        public function project()
        {
            return $this->belongsTo(Project::class);
        }
    
        // Relationship with Result
        public function results()
        {
            return $this->hasMany(Result::class);
        }
}
