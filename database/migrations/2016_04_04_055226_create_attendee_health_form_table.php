<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeeHealthFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_health_release_forms', function (Blueprint $table) {
            $table->integer('attendee_id')->unsigned();
            $table->string('gender', 5);
            $table->string('emg_contactname');
            $table->string('emg_contactrel');
            $table->string('emg_contactnumber');
            $table->text('healthproblems')->nullable();
            $table->text('allergies')->nullable();
            $table->text('medications')->nullable();
            $table->DATE('lasttetanusshot')->nullable();
            $table->DATE('lastphysicalexam')->nullable();
            $table->string('insurancecarrier')->nullable();
            $table->string('insurancepolicynum')->nullable();
            $table->text('liability_statement')->nullable();
            $table->string('guardian_name');
            $table->string('guardian_relation');
            $table->string('guardian_contact');
            $table->text('guardian_sign');
            $table->text('student_sign');
            $table->timestamps();

            $table->foreign('attendee_id')
                ->references('id')
                ->on('attendees')
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
        Schema::drop('attendee_health_release_forms');
    }
}
