<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Companion extends Model
{
    protected $fillable = [
        'patient_id',
        'name',
        'cpf',
        'phone',
        'kinship',
        'active'
    ];
        // Se o campo na migração for 'patient_id'
        public function patient(): BelongsTo
        {
            return $this->belongsTo(Patient::class, 'patient_id'); // Note o 'patient_id'
        }

        protected static function boot()
        {
            parent::boot();
        
        #    static::creating(function ($model) {
        #if (empty($model->patient_id)) { // Ou 'patient' conforme migração
        #    throw new \Exception('Um acompanhante deve estar associado a um paciente');
        #}
        #});
}
}