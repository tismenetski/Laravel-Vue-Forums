<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies_votes', function (Blueprint $table) {
            $table->id();
            $table->integer('value')->default(0);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('reply_id')->unsigned()->nullable();
            $table->foreign('reply_id')->references('id')->on('replies')->onDelete('cascade');
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
        Schema::dropIfExists('replies_votes');
    }
}
