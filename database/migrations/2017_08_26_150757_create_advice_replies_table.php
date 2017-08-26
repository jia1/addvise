<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdviceRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('advice_replies', function (Blueprint $table) {
             $table->increments('id');
             $table->bigInteger('facebook_reply_id')->unsigned()->unique()->index();
             $table->bigInteger('facebook_user_id')->unsigned()->index();
             $table->bigInteger('facebook_comment_id')->unsigned()->index();
             $table->timestampTz('added_on');
         });
         Schema::table('advice_replies', function($table) {
            $table->foreign('facebook_user_id')->references('facebook_user_id')->on('users');
            $table->foreign('facebook_comment_id')->references('facebook_comment_id')->on('advice_given');
        });
     }
 
     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::dropIfExists('advice_replies');
     }
}