<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollumnSolicitante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitantes', function (Blueprint $table) {
            $table->string('nome');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('tipo_solicitante_id');
            $table->foreign('tipo_solicitante_id')->references('id')->on('tipo_solicitante');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitantes', function (Blueprint $table) {
            $table->dropColumn('nome');
            $table->dropColumn('email');
            $table->dropColumn('tipo_solicitante_id');
        });
    }
}
