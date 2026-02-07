<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    public $timestamps = false;

    // Metodo que se ejecuta al crear o actualizar un empleado para manejar las fechas de auditoría
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($empleado) {
            //$empleado->fe_creacion = "2026-02-06 21:26:43"; //now()->format('Y-m-d H:i:s');
        });
        
        static::updating(function ($empleado) {
            //$empleado->fe_ult_mod = now()->format('Y-m-d H:i:s');
        });
    }
}
