<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $id = \DB::table('book_sources')->insertGetId(
            [
                'url' => 'https://www.piter.com',
                'active' => true
            ]
        );
        \DB::table('source_pages')->insert(
            [
                'path' => '/collection/biblioteka-programmista',
                'book_source_id' => $id
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
        \DB::table('source_pages')->where('book_source_id','=',1)->delete();
        \DB::table('book_sources')->where('id','=',1)->delete();
    }
}
