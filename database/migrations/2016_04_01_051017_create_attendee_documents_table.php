<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeeDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_documents', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('attendee_id')->unsigned();
            $table->integer('doc_def_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->timestamps();

            $table->foreign('attendee_id')
                ->references('id')
                ->on('attendees')
                ->onDelete('cascade');

            $table->foreign('doc_def_id')
                ->references('id')
                ->on('document_definitions');

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
        Schema::drop('attendee_documents');
    }
}
