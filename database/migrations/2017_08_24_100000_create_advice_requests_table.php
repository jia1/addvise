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
            $table->bigInteger('facebook_post_id')->unsigned()->unique()->index();
            $table->bigInteger('facebook_user_id')->unsigned()->index();
        });
        Schema::table('advice_requests', function($table) {
            $table->foreign('facebook_user_id')->references('facebook_user_id')->on('users');
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
