<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Solicitante extends Model
{
    use Notifiable;

    protected $fillable = [
        'nome', 'email', 'tipo_solicitante_id'
    ];
    protected $table = 'solicitantes';
}
