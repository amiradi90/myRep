<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('partref');
            $table->string('partcode', 20);
            $table->string('barcode', 20)->nullable();
            $table->string('partname', 100);
            $table->unsignedInteger('shelf');
            $table->unsignedInteger('stock');
            $table->string('grp', 50)->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('creator')->nullable();
            $table->unsignedInteger('updater')->nullable();
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('places');
    }
}
