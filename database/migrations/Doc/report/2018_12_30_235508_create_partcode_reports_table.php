<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartcodeReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partcodeReports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->string('grp', 50)->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('creator');
            $table->boolean('nameConflict')->nullable();
            $table->boolean('grpConflict')->nullable();
            $table->boolean('priceConflict')->nullable();
            $table->boolean('considered')->nullable();
            $table->string('description',255)->nullable();
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
        Schema::dropIfExists('todos');
    }
}
