<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
  use HasFactory;

  protected $table = 'trabajador';

  protected $fillable = [
    'nrodoc',
    'nombres',
    'apellidos',
    'telefono',
    'email',
  ];
  
  public function usuario()
  {
    return $this->belongsTo(User::class, 'id');
  }

}
