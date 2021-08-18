<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearcherEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researcher_education', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->year('year');
            $table->string('institution',200);
            $table->string('program',200);
            $table->smallInteger('qualification_id')->unsigned()->index();
            $table->foreign('qualification_id')->references('id')->on('dropdowns')->onDelete('cascade');
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
        Schema::dropIfExists('researcher_education');
    }
}
