<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //

    public function tournaments(){
        return $this->hasMany('App\Tournament', 'idEsilan');
    }

    public function fullImgPathOrDefault(){
        if (is_null($this->imgName)) return "img/default_avatar.png";
        return "upload/".$this->imgName;
    }
}
