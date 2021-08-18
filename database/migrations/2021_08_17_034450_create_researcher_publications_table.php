<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearcherPublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researcher_publications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->year('year');
            $table->string('title',200);
            $table->string('description');
            $table->integer('researcher_id')->unsigned()->index();
            $table->foreign('researcher_id')->references('id')->on('researchers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('researcher_publications');
    }
}
