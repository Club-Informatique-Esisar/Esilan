<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ticket_types';

    public function esilan(){
        return $this->belongsTo('App\Esilan', 'idEsilan');
    }

    public function tickets(){
        return $this->hasMany('App\Ticket', 'idTicketType');
    }

    public function tournaments(){
        return $this->belongsToMany('App\Tournament', 'tick_tour_compatibilities', 'idTicketType','idTournament');
    }

    public function nbSales(){
        return $this->tickets->count();
    }

    public function salePercentage(){
        if ($this->maxTicket == 0){
            return 0;
        }
        return (($this->nbSales())/($this->maxTicket))*100;
    }

    public function nbTicketAvailable(){
        return ($this->maxTicket - $this->nbSales());
    }
}
