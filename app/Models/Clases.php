<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clases extends Model
{
  use HasFactory;

  protected $fillable = [
    'idusers',
    'clase',
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