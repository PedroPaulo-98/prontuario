<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'initials',
        'cnes',
        'cep',
        'street',
        'district',
        'city',
        'active'
    ];
}
