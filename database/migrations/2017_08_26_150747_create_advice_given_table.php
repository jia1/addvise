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
            $table->bigInteger('facebook_comment_id')->unsigned()->unique()->index();
            $table->bigInteger('facebook_user_id')->unsigned()->index();
            $table->bigInteger('facebook_post_id')->unsigned()->index();
            $table->timestampTz('added_on');
        });
        Schema::table('advice_given', function($table) {
            $table->foreign('facebook_user_id')->references('facebook_user_id')->on('users');
            $table->foreign('facebook_post_id')->references('facebook_post_id')->on('advice_requests');
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
