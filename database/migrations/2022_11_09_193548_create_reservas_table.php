<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->string('codigoProfesor',10)->unsigned();
            $table->integer('idEquipo',255)->unsigned();
            $table->time('hora');
            $table->date('fecha');
            $table->time('horaInicio');
            $table->time('horaFin');
            $table->string('estado',30);
            $table->timestamps('created_at');

            //on delete cascade la primera clave foranea
            $table->foreign('codigoProfesor')->references('codigo')->on('users')->onDelete('cascade');
            $table->foreign('idEquipo')->references('id')->on('equipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
};
