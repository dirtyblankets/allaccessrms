<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('name');
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('organizations');
        });      

        Schema::create('organization_address', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('organization_id')->unsigned()->unique();
            $table->string('address', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 5)->nullable();
            $table->string('zipcode', 20)->nullable();
            $table->string('country', 5)->nullable();
            $table->timestamps();

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('cascade');
        });  

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->string('email', 100)->unique();
            $table->string('password', 60);
            $table->string('firstname');
            $table->string('lastname');
            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('cascade');
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->string('title', 100)->nullable();
            $table->text('description')->nullable();
            $table->DATE('start_date')->nullable();
            $table->DATE('end_date')->nullable();
            $table->TIME('start_time')->nullable();
            $table->TIME('end_time')->nullable();
            $table->string('contact_phone', 30)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('cascade');              
        });

        Schema::create('eventsites', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->string('name');
            $table->string('address', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 5)->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->string('country', 5)->nullable();
            $table->decimal('price', 10, 2)->nullable();

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
        });

        Schema::create('attendees', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('organization_id')->unsigned()->nullable();
            $table->integer('event_id')->unsigned();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email', 100);
            $table->date('registration_date');
            $table->float('amount_paid', 16, 2)->nullable();
            $table->float('total_amount', 16, 2)->nullable();
            $table->string('phone_number', 30)->nullable();
            $table->timestamps();

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('cascade');

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
        Schema::drop('organizations');
        Schema::dorp('organization_address');
        Schema::drop('eventsites');
        Schema::drop('events');
        Schema::drop('users');
        Schema::drop('attendees');
    }
}
