<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token', 32)->unique();
            $table->integer('user_id');
            $table->tinyInteger('type')->comment('1 Password / 2 Confirmação');
            $table->timestamps();
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
        Schema::dropIfExists('users_tokens');
    }

}
