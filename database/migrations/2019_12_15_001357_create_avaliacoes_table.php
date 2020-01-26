<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliacoesTable extends Migration
{
    public function up()
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('estrelas')->unsigned();
            //tem um usuario
            $table->unsignedBigInteger('anime_id');
            $table->foreign('anime_id')->references('id')->on('animes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('avaliacoes');
    }
}
