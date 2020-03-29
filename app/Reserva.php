<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Reserva extends Model
{

    use Notifiable;
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
