<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_infos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->smallIncrements('id');
            $table->string('amount');
            $table->date('period');
            $table->date('funded_at');
            $table->smallInteger('funded_id')->unsigned()->index();
            $table->foreign('funded_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->smallInteger('research_id')->unsigned()->index();
            $table->foreign('research_id')->references('id')->on('researches')->onDelete('cascade');
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
        Schema::dropIfExists('research_infos');
    }
}
