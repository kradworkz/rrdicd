<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_lists', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code');
            $table->string('description')->nullable();
            $table->smallInteger('status_id')->unsigned()->index();
            $table->foreign('status_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->integer('inventory_id')->unsigned()->index();
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->date('purchased_at')->nullable();
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
        Schema::dropIfExists('inventory_lists');
    }
}
