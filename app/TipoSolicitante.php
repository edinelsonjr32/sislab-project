<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TipoSolicitante extends Model
{
    use Notifiable;

    protected $table = 'tipo_solicitante';

    protected $fillable = [
        'nome',
        'status',
    ];
}
