<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSelectors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('book_selectors')->insert(
            [
                'link' => '.products-list .book-block > a',
                'name' => '.product-info > h1',
                'image' => '.photo .img img',
                'authors' => '.product-info .author span',
                'year' => '.params ul li:nth-child(2) span:nth-child(2)',
                'price' => '.product-variant .price',
                'book_source_id' => 1
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('book_selectors')->where('book_source_id','=',1)->delete();
    }
}
