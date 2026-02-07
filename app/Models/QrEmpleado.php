<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrEmpleado extends Model
{
    use HasFactory;

    protected $table = 'qr_empleados';

    public $timestamps = false;

    
}
