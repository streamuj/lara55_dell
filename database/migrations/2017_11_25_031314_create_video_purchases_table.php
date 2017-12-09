<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned();
            $table->integer('purchaser_id')->unsigned();
            $table->integer('performer_id')->unsigned();
            $table->decimal('purchased_credits', 8, 2)->unsigned();
            $table->decimal('performer_credits', 8, 2)->unsigned();
            $table->decimal('club_credits', 8 , 2)->unsigned();
            $table->decimal('ServiceProvider_credits', 8 ,2)->unsigned();
            $table->string('unique_id');

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
        Schema::dropIfExists('video_purchases');
    }
}
