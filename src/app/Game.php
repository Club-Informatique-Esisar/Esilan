<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Utils\ImageLibrary\ImageLibrary;

class Game extends Model
{
    //

    public function tournaments(){
        return $this->hasMany('App\Tournament', 'idEsilan');
    }

    public function fullImgPathOrDefault($size = null){
        if (is_null($this->imgName)) return "img/default_avatar.png";
        return ImageLibrary::getFile($this->imgName, $size);
    }
}
