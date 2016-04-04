<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_invites', function (Blueprint $table){
            $table->increments('id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->string('attendee_email');
            $table->string('attendee_name');
            $table->string('invite_code');
            $table->timestamps();

            $table->unique(['event_id', 'attendee_email']);

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attendee_invites');
    }
}
