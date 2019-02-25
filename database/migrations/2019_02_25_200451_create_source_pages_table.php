<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourcePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('source_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->unsignedInteger('book_source_id');

            $table->foreign('book_source_id')->references('id')->on('book_sources');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('source_pages');
    }
}
