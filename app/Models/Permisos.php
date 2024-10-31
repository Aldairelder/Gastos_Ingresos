<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;

    protected $table = 'permisos';

    protected $fillable = [
        'idrol',
        'idmodulo',
        'r',
        'w',
        'u',
        'd',
    ];

    public function modulo()
    {
        return $this->belongsTo(Modulos::class, 'id');
    }

}
