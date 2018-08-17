<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    //

    protected $dates = [
        'beginDate',
        'endDate',
        'created_at',
        'updated_at'
    ];

    public function esilan(){
        return $this->belongsTo('App\Esilan', 'idEsilan');
    }
    public function game(){
        return $this->belongsTo('App\Game', 'idGame');
    }
    public function compatibilities(){
        return $this->belongsToMany('App\TicketType', 'tick_tour_compatibilities', 'idTournament', 'idTicketType');
    }
    public function gamers(){
        return $this->belongsToMany('App\User', 'tournament_participations', 'idTournament', 'idGamer');
    }

    public function compatibleWithTicketType($idTicketType){
        foreach ($this->compatibilities as $type) {
            if ($type->id == $idTicketType){
                return true;
            }
        }
        return false;
    }
}
