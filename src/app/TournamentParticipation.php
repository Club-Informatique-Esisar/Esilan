<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentParticipation extends Model
{
    //
    public function tournament(){
        return $this->belongsTo('App\Tournament', 'idTournament');
    }
    public function gamer(){
        return $this->belongsTo('App\Gamer', 'idGamer');
    }
}
