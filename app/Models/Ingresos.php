<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
  use HasFactory;

  protected $fillable = [
    'idclase',
    'identidad',
    'serie',
    'nrodoc',
    'titulo',
    'descripcion',
    'total',
    'archivo',
  ];

  public function clase()
  {
    return $this->belongsTo(Clases::class, 'idclase');
  }

  public function entidad()
  {
    return $this->belongsTo(Entidades::class, 'identidad');
  }

  public function detalles()
  {
    return $this->hasMany(IngresosDetalles::class, 'idingreso');
  }
}
