<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SourcePage extends Model
{
    public function source()
    {
        return $this->belongsTo('App\BookSource');
    }
}
