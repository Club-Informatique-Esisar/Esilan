<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Utils\ImageLibrary\ImageLibrary;

class Esilan extends Model
{

    protected $dates = [
        'beginDate',
        'endDate',
        'created_at',
        'updated_at'
    ];

    public function ticketTypes(){
        return $this->hasMany('App\TicketType', 'idEsilan');
    }

    public function tournaments(){
        return $this->hasMany('App\Tournament', 'idEsilan');
    }

    public function nbPlacesAvailable(){
        $res = 0;
        foreach ($this->ticketTypes as $type) {
            $res += $type->maxTicket;
        }
        return $res;
    }
    public function nbPlacesSales(){
        $res = 0;
        foreach ($this->ticketTypes as $type) {
            $res += $type->nbSales();
        }
        return $res;
    }

    public function fullImgPathOrDefault($size = null){
        if (is_null($this->imgName)) return "img/default_avatar.png";
        return ImageLibrary::getFile($this->imgName, $size);
    }
}
