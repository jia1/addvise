<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdviceGivenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advice_given', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('fb_comment_id')->unsigned()->unique()->index();
            $table->bigInteger('fb_user_id')->unsigned()->index();
            $table->bigInteger('fb_post_id')->unsigned()->index();
        });
        Schema::table('advice_given', function($table) {
            $table->foreign('fb_user_id')->references('fb_user_id')->on('users');
            $table->foreign('fb_post_id')->references('fb_post_id')->on('advice_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advice_given');
    }
}
