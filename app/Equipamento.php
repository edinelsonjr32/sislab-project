<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Equipamento extends Pivot
{
    protected $table = 'equipamento';

    protected $fillable = [
        'tombo',
        'descricao',
        'tipo_equipamento_id',
        'path'
    ];

    public function reservasEquipamentos(){
        return $this->hasMany(ReservaEquipamento::class);
    }


    public function tipoEquipamento(){
        return $this->belongsTo(TipoEquipamento::class);
    }

}
