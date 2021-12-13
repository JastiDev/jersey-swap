<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deal_id');
            $table->foreign('deal_id')->references('id')->on('deals');
            $table->unsignedBigInteger('given_by');
            $table->foreign('given_by')->references('id')->on('users');
            $table->unsignedBigInteger('given_to');
            $table->foreign('given_to')->references('id')->on('users');
            $table->integer('rating')->default(0);
            $table->string('feedback',500)->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
