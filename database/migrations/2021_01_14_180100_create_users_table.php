<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('public_key', 32)->unique();
            $table->string('name', 75);
            $table->string('username', 30)->unique();
            $table->string('email', 200)->unique();
            $table->tinyInteger('status')->default(1)->comment('0 Desativado / 1 Ativo');
            $table->tinyInteger('role_id')->default(1)->comment('roles.id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 250);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            $table->foreign('role_id')->references('id')->on('roles');
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
        Schema::dropIfExists('users');
    }

}
