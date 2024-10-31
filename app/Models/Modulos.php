<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    use HasFactory;
    
    protected $table = 'modulo';

    protected $fillable = [
        'modulo',
        'descripcion'
    ];

    public function permiso()
    {
        return $this->hasMany(Permisos::class, 'idmodulo');
    }
}
