<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('consumer_number',30)->unique();
            $table->string('email', 50)->unique();
            $table->string('mobile_number',15)->unique();
            $table->string('otp',10);
            $table->tinyInteger('otp_verified')->default(0);
            $table->dateTime('otp_time');
            $table->string('password');
            $table->tinyInteger('status')->default(0);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
