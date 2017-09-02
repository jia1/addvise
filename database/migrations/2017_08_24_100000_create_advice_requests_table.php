<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdviceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advice_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('fb_post_id')->unsigned()->unique()->index();
            $table->bigInteger('fb_user_id')->unsigned()->index();
            $table->integer('label')->unsigned()->index();
        });
        Schema::table('advice_requests', function($table) {
            $table->foreign('fb_user_id')->references('fb_user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advice_requests');
    }
}
