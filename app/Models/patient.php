<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    #use HasFactory;

    protected $fillable = [
        'name',
        'social_name',
        'breed',
        'birth_date',
        'sex',
        'cpf',
        'cns',
        'rg',
        'uf_rg',
        'expediter',
        'marital_status',
        'nationallity',
        'naturalness',
        'uf_naturalness',
        'phone',
        'cep',
        'street',
        'complement',
        'district',
        'city',
        'state',
    ];

    public function companions(): HasMany
    {
        return $this->hasMany(Companion::class, 'patient_id');
    }
}
