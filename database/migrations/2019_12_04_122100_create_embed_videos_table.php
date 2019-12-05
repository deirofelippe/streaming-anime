<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmbedVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('embed_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('html_embed_video');
            $table->string('nome');
            $table->string('resolucao', 5);
            $table->string('sub_dub', 3);
            $table->unsignedBigInteger('episodio_id');
            $table->foreign('episodio_id')->references('id')->on('episodios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('embed_videos');
    }
}
