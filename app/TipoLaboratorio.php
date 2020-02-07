<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoLaboratorio extends Model
{
    protected $table = 'tipo_laboratorio';

    protected $fillable = ['nome', 'status'];
}
