<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookSelectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_selectors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link');
            $table->string('name');
            $table->string('image');
            $table->string('authors');
            $table->string('year');
            $table->string('price');
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
        Schema::dropIfExists('book_selectors');
    }
}
