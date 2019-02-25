<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookSource extends Model
{
    public function pages()
    {
        return $this->hasMany('App\SourcePage');
    }

    public function selectors()
    {
        return $this->hasOne('App\BookSelector');
    }
}
