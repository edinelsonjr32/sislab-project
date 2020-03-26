<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reserva';

    protected $fillable = [

        'solicitante_id',
        'laboratorio_id',
        'data',
        'hora_inicio',
        'hora_fim',
        'status',
        'usuario_id',
        'observacao'
    ];
}
