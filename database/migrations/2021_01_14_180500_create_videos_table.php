<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title', 255)->comment('Nome e/ou título do vídeo');
            $table->string('youtube', 255)->comment('Código do vídeo do youtube');
            $table->text('description')->nullable()->comment('Descrição do vídeo');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes('deleted_at', 0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->engine = 'MyISAM';
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }

}