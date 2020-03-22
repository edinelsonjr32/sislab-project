<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->unsignedBigInteger('solicitante_id');
            $table->foreign('solicitante_id')->references('id')->on('solicitantes');
            $table->unsignedBigInteger('laboratorio_id');
            $table->foreign('laboratorio_id')->references('id')->on('laboratorio');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva');
    }
}
