<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researchers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->smallInteger('designation_id')->unsigned()->index();
            $table->foreign('designation_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->smallInteger('specialty_id')->unsigned()->index();
            $table->foreign('specialty_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->smallInteger('institution_id')->unsigned()->index();
            $table->foreign('institution_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('researchers');
    }
}
