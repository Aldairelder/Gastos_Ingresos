<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
  use HasFactory;

  protected $fillable = [
    'idclase',
    'serie',
    'nrodoc',
    'titulo',
    'descripcion',
    'archivo',
    'total',
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
    return $this->hasMany(GastosDetalles::class, 'idgasto');
  }
}