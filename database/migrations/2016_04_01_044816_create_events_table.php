<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
            $table->integer('price')->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('published')->default(0);
            $table->boolean('private')->default(0);
            $table->timestamps();

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onDelete('cascade');              
        });

        Schema::create('event_sites', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->string('name');
            $table->string('address', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 5)->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->string('country', 5)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
            
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
        Schema::drop('events');
        Schema::drop('eventsites');
    }
}
