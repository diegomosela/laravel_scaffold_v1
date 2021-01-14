<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('url');
            $table->string('method', 10);
            $table->string('ip', 30);
            $table->string('agent');
            $table->json('json')->nullable();
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
        Schema::dropIfExists('users_logs');
    }

}
