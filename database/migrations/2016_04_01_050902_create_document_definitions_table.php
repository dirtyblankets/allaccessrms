<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_definitions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->string('document_name');
            $table->text('statement')->nullable();
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
        Schema::drop('document_definitions');
    }
}
