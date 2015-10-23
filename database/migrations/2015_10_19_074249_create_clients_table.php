<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

    /**
     * Run the migrations.
     * @return void
     */
    public function up() {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('phone_number', 20)->unique();
            $table->string('post_code', 15);
            $table->string('pickup_location');
            $table->boolean('non_payer');
            $table->tinyInteger('stars');
            $table->boolean('excellent_customer');
            $table->tinyInteger('excellent_stars');
            $table->string('time_of_incident');
            $table->string('incident_note');
            $table->integer('advice_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
        Schema::drop('clients');
    }

}
