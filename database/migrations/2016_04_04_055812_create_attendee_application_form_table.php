<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeeApplicationFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_doc_app_forms', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('attendee_document_id')->unsigned();
            $table->DATE('birthdate')->nullable();
            $table->string('address', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 5)->nullable();
            $table->string('zipcode', 20)->nullable();
            $table->string('country', 5)->nullable();
            $table->string('student_phone')->nullable();
            $table->string('student_grade', 5)->nullable();
            $table->string('sweatshirt_size', 5)->nullable();
            $table->string('language', 5)->nullable();
            $table->timestamps();

            $table->foreign('attendee_document_id')
                ->references('id')
                ->on('attendee_documents')
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
        Schema::drop('attendee_doc_app_forms');
    }
}
