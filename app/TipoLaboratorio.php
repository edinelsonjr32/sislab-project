<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TipoLaboratorio extends Model
{
    use Notifiable;
    protected $table = 'tipo_laboratorio';

    protected $fillable = ['nome', 'status'];
}
