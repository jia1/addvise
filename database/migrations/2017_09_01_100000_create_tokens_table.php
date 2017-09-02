<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->text('fb_user_token_temp');
            $table->text('fb_user_token_long');
            $table->bigInteger('fb_user_id')->unsigned()->unique()->index();
        });
        Schema::table('tokens', function($table) {
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
        Schema::dropIfExists('tokens');
    }
}
