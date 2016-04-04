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
        Schema::create('attendee_health_form', function (Blueprint $table) {
            $table->integer('attendee_id')->unsigned();
            $table->integer('health_form_id')->unsigned();
            $table->string('gender', 5);
            $table->string('guardianfullname');
            $table->string('relationship');
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
            $table->text('guardiansignature');
            $table->text('studentsignature');
            $table->timestamps();

            $table->primary('attendee_id');

            $table->foreign('attendee_id')
                ->references('id')
                ->on('attendees')
                ->onDelete('cascade');

            $table->foreign('health_form_id')
                ->references('id')
                ->on('health_forms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attendee_health_form');
    }
}
