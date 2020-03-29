<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Laboratorio extends Model
{
    use Notifiable;
    protected $table = 'laboratorio';

    protected $fillable = ['nome', 'tipo_laboratorio_id'];
}
