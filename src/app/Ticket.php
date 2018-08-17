<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $dates = [
        'dateCreation',
        'dateValidation',
        'created_at',
        'updated_at'
    ];

    public function ticketType(){
        return $this->belongsTo('App\TicketType', 'idTicketType');
    }

    public function gamer(){
        return $this->belongsTo('App\User', 'idGamer');
    }

    public function userValidator(){
        return $this->belongsTo('App\User', 'validator');
    }

}
