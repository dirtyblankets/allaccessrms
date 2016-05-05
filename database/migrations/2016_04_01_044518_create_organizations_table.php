<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
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
                ->on('organizations')
                ->onDelete('cascade');
        });      

        Schema::create('organization_info', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('organization_id')->unsigned()->unique();
            $table->string('email', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 5)->nullable();
            $table->string('zipcode', 20)->nullable();
            $table->string('country', 5)->nullable();
            $table->string('telephone', 10)->nullable();
            $table->string('fax', 10)->nullable();
            $table->timestamps();

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
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
        Schema::drop('organization_info');
    }
}
