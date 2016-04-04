<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->string('email', 100)->unique();
            $table->string('password', 60)->nullable();
            $table->string('temp_password', 60)->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('telephone')->nullable();
            $table->boolean('active')->default(1);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
