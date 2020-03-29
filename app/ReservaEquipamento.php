<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservaEquipamento extends Model
{
    protected $table = 'reserva_equipamento';

    protected $fillable = ['equipamento_id', 'reserva_id', 'status'];
}
