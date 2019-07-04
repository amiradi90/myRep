<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    protected $connection='sqlsrv';
    public function up()
    {
//        Schema::create('AMM.posts', function (Blueprint $table) {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',200)->nullable();
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
        Schema::dropIfExists('posts');
    }
}
