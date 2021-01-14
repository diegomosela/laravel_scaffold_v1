<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('source', 50)->comment('Nome da plataforma que enviou a mensagem');
            $table->integer('external_id')->comment('Código da mensagem enviada pela plataforma');
            $table->tinyInteger('type');
            $table->string('from', 200);
            $table->string('to', 200);
            $table->string('subject', 250);
            $table->longText('view');
            $table->timestamp('created_at');
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
        Schema::dropIfExists('messages');
    }

}