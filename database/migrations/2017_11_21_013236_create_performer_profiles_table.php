<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performer_profiles', function (Blueprint $table) {

            $table->integer('user_id')->index();
            $table->string('nickname');
            $table->string('description');
            $table->string('landing_image_path')->nullable()->default('users/defaultProfile.png');
            $table->string('turnOn');
            $table->string('turnOff');
            $table->string('ethnicity');
            $table->string('height');
            $table->string('hair_color');
            $table->string('eye_color');
            $table->string('build');
            $table->string('cup_size');
            $table->date('birthday');
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
        Schema::dropIfExists('performer_profiles');
    }
}
