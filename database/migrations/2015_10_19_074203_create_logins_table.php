<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoginsTable extends Migration {

    /**
     * Run the migrations.
     * @return void
     */
    public function up() {
        Schema::create('logins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name', 60)->unique();
            $table->string('password', 60);
            $table->string('access_token', 60)->unique();
            $table->boolean('active');
            $table->integer('user_id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
        Schema::drop('logins');
    }

}
