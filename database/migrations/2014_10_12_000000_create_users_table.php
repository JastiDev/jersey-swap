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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role')->unique();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('f_name',50);
            $table->string('l_name',50);
            $table->string('tag_line',50)->nullable();
            $table->string('about',1000)->nullable();
            $table->string('email')->unique();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('phone')->nullable();
            $table->string('postcode',20)->nullable();
            $table->string('address',200)->nullable();
            $table->string('profile_picture',100)->default('assets/images/user-avatar.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('suspended')->nullable();
            $table->boolean('banned')->nullable();
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
        Schema::dropIfExists('users');
    }
}
