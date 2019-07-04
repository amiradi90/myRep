<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drafts', function (Blueprint $table) {
            $table->increments('id');
            $table->int('partref', 15)->nullable();
            $table->string('partcode', 20);
            $table->string('partname', 100)->nullable();
            $table->unsignedInteger('vchnum');
            $table->unsignedInteger('vchtype');
            $table->unsignedInteger('stockRef');
            $table->unsignedInteger('opStockRef');
            $table->unsignedInteger('qty');
            $table->unsignedInteger('cnt')->nullable();
            $table->unsignedInteger('cntChecked')->nullable();
            $table->string('pDate')->nullable();
            $table->string('grp', 50)->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->boolean('checked')->nullable();
            $table->boolean('confirmed')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('creator')->nullable();
            $table->unsignedInteger('updater')->nullable();
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
        Schema::dropIfExists('drafts');
    }
}
