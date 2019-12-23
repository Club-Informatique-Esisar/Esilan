<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    static private $roles = [
        0 => 'gamer',
        1 => 'shop_manager',
        2 => 'administrator'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * 
     * @param  string  $role
     * @return mixed
     */
    public function hasRole(string $role)
    {
        return array_search($this->role, static::$roles) >= array_search($role, static::$roles);
    }

    static public function getRoleAsArray(){
        return static::$roles;
    }

    public function tickets(){
        return $this->hasMany('App\Ticket', 'idGamer');
    }

    public function participations(){
        return $this->belongsToMany('App\Tournament', 'tournament_participations', 'idGamer','idTournament');
    }

    public function isRegisterToEsilan($idLan){
        foreach($this->tickets as $ticket){
            if ($ticket->ticketType->esilan->id == $idLan){
                return true;
            }
        }
        return false;
    }

    public function fullImgPathOrDefault(){
        if (is_null($this->imgName)) return "img/default_avater.png";
        return "upload/".$this->imgName;
    }

}
