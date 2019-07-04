<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zinos', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('zinoId');
            $table->string('title',200)->nullable();
            $table->string('barcode',20)->nullable();
            $table->bigInteger('price')->nullable();
            $table->string('date',10);
            $table->string('image',100);
            $table->integer('gId');
            $table->string('gTitle',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
//    'zinoId', 'title', 'price','barcode','date','image','groupTitle','groupId'
    public function down()
    {
        Schema::dropIfExists('zinos');
    }
}
