<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing', function (Blueprint $table) {
            $table->id();
            $table->string('product_title',100);
            $table->string('product_description',1000);
            $table->string('product_img');
            $table->unsignedBigInteger('posted_by');
            $table->boolean('authentic')->default(0);
            $table->string('slug',100)->unique();
            $table->string('status',100)->default('posted');
            $table->foreign('posted_by')->references('id')->on('users');
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
        Schema::dropIfExists('listing');
    }
}
