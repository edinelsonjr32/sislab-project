<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $table = 'equipamento';

    protected $fillable = [
        'tombo',
        'descricao',
        'tipo_equipamento_id',
        'path'
    ];

}
