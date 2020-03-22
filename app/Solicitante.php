<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    protected $fillable = [
        'nome', 'email', 'tipo_solicitante_id'
    ];
    protected $table = 'solicitantes';
}
