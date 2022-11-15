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
        Schema::create('inventario', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->string('numInventario',255);
            $table->string('ubicacion',50)->constraint();
            $table->bigInteger('idEquipo',255)->unsigned();
            $table->string('descripcion',255);
            $table->string('estado',30);

            //on delete cascade la primera clave foranea
            $table->foreign('idEquipo')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('ubicacion')->references('id')->on('ubicaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventario');
    }
};
