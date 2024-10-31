<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresosDetalles extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'idingreso',
    'detalle',
    'cantidad',
    'precio'
  ];

  public function ingreso()
  {
    return $this->belongsTo(Ingresos::class, 'idingreso');
  }
}
