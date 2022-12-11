<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisscussionRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disscussion_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discussion_id')->unsigned();
            $table->text('message');
            $table->timestamps();

            $table->foreign('discussion_id')->references('id')->on('discussions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disscussion_replies');
    }
}
