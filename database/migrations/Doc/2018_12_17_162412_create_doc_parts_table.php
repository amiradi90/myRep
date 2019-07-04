<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocPartsTable extends Migration
{

    public function up()
    {
        Schema::create('docParts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('barcode', 20)->nullable();
            $table->string('partcode', 20);
            $table->string('name', 200)->nullable();
            $table->unsignedInteger('cnt');
            $table->string('grp', 50)->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('seq');
            $table->unsignedInteger('doc_id');
            $table->unsignedInteger('creator');
            $table->unsignedInteger('updater');
            $table->timestamps();

            $table->foreign('doc_id')->references('id')->on('docs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('docParts');
    }
}
