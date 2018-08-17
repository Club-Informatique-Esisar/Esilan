<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TickTourCompatibility extends Model
{
    //
    public function tournament(){
        return $this->belongsTo('App\Tournament', 'idTournament');
    }
    public function ticketType(){
        return $this->belongsTo('App\TicketType', 'idTicketType');
    }
}
