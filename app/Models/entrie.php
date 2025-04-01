<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entrie extends Model
{
    use HasFactory;

    protected $fillable = [
        'bpa',
        'unit_id',
        'entry',
        'patient_id',
        'information',
        'reason_id',
        'origin_id',
        'companion_id',
        'ambulance',
        'work',
        'police',
        'mistreatment',
        'native',
        'intercurrence'
    ];
    public function unit()
{
    return $this->belongsTo(Unit::class);
}

public function patient()
{
    return $this->belongsTo(Patient::class);
}

public function companion()
{
    return $this->belongsTo(Companion::class);
}

public function reason()
{
    return $this->belongsTo(Reason::class);
}

public function origin()
{
    return $this->belongsTo(Origin::class);
}
}
