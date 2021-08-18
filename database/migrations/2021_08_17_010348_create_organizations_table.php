<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->engine = 'InnoDB';
            $table->smallIncrements('id');
            $table->string('name',200);
            $table->string('acronym',20)->defualt('n/a');
            $table->string('email')->unique();  
            $table->string('mobile_no',15);
            $table->string('avatar',200)->default('school.jpg');
            $table->smallInteger('type_id')->unsigned()->index();
            $table->foreign('type_id')->references('id')->on('dropdowns')->onDelete('cascade');
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
        Schema::dropIfExists('organizations');
    }
}
