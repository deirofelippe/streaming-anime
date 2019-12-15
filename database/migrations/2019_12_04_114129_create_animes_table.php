<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->string('nome')->unique()->nullable(false);
            $table->string('estudio')->nullable(false);
            $table->string('thumbnail')->default('/img/sem-img.jpg')->unique()->nullable(false);
            $table->tinyInteger('status', false, true);
            $table->text('descricao');
            $table->addColumn('year', 'ano_lancamento');
            $table->unsignedInteger('views')->default(0);
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
        Schema::dropIfExists('animes');
    }
}
