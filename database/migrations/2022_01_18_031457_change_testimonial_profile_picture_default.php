<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeTestimonialProfilePictureDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `testimonials` CHANGE COLUMN `avatar` `avatar` VARCHAR(100) NOT NULL DEFAULT 'default-user.png';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `testimonials` CHANGE COLUMN `avatar` `avatar` VARCHAR(100) NOT NULL DEFAULT 'assets/images/user-avatar.png';");
    }
}
