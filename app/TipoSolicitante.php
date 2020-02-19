<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSolicitante extends Model
{
    protected $table = 'tipo_solicitante';

    protected $fillable = [
        'nome',
        'status',
    ];
}
