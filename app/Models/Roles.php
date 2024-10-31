<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'rol';

    protected $fillable = [
        'rol',
        'descripcion'
    ];

    public function usuario()
    {
        return $this->hasMany(Roles::class, 'id');
    }
}
