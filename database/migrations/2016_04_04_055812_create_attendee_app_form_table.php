<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeeAppFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_app_form', function (Blueprint $table) {
            $table->integer('attendee_id')->unsigned();
            $table->integer('application_form_id')->unsigned();
            $table->DATE('birthdate')->nullable();
            $table->string('address', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 5)->nullable();
            $table->string('zipcode', 20)->nullable();
            $table->string('country', 5)->nullable();
            $table->string('student_phone')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('student_grade', 5)->nullable();
            $table->string('sweatshirt_size', 5)->nullable();
            $table->string('language', 5)->nullable();
            $table->text('medical_difficulty')->nullable();
            $table->text('allergy_meds')->nullable();
            $table->string('parent_name');
            $table->text('parent_signature');
            $table->timestamps();

            $table->primary('attendee_id');

            $table->foreign('attendee_id')
                ->references('id')
                ->on('attendees')
                ->onDelete('cascade');

            $table->foreign('application_form_id')
                ->references('id')
                ->on('application_forms'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attendee_app_form');
    }
}
