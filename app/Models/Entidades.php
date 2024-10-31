<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidades extends Model
{
  use HasFactory;

  protected $fillable = [
    'tipo',
    'nrodoc',
    'entidad',
    'direccion',
    'telefono',
    'email',
  ];

  public function ingresos()
  {
    return $this->hasMany(Ingresos::class);
  }

  public function gastos()
  {
    return $this->hasMany(Gastos::class);
  }
}
