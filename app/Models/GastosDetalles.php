<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastosDetalles extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'idgasto',
    'detalle',
    'cantidad',
    'precio'
    
  ];

  public function gasto()
  {
    return $this->belongsTo(Gastos::class, 'idgasto');
  }
  
}
