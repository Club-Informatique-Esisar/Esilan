<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //

    public function tournaments(){
        return $this->hasMany('App\Tournament', 'idEsilan');
    }
}
