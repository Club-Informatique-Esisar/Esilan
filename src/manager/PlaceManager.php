<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

include_once '../class/Tournoi.php';

/*
	private $idGamer; 		 // integer PK FK
	private $idTypePlace; 	 // integer PK FK
	
	private $valide; 	     // boolean
 */


class PlaceManager 
{
    private $_db; // Instance de PDO
    
    public function __construct($db)
    {
        $this->setDb($db);
    }
    
    public function add(Place $place)
    {
        $q = $this->_db->prepare('INSERT INTO Place(idGamer, idTypePlace, valide) VALUES(:idGamer, :idTypePlace, :valide)');
        
        $q->bindValue(':idGamer', $place->getIdGamer(), PDO::PARAM_INT);
        $q->bindValue(':idTypePlace', $place->getIdTypePlace(), PDO::PARAM_INT);
        $q->bindValue(':valide', $place->getValide(), PDO::PARAM_BOOL);
        
        $q->execute();
    }
    
    public function delete(Place $place)
    {
        $this->_db->exec('DELETE FROM Place WHERE idGamer = '.$place->getIdGamer().' AND idTypePlace = '.$place->getIdTypePlace());
    }
    
    public function get($idGamer, $idTypePlace){
        $idGamer = (int) $idGamer;
        $idTypePlace = (int) $idTypePlace;
        
        $q = $this->_db->query('SELECT idGamer, idTypePlace, valide FROM Place WHERE idGamer = '.$idGamer.'AND idTypePlace = '.$idTypePlace);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        
        return new Place($donnees);
    }
    
    
    public function getPlacesFromIdTypePlace($idTypePlace){
        $places = [];
        
        $q = $this->_db->query('SELECT idGamer, idTypePlace, valide FROM Place WHERE idTypePlace = '.$idTypePlace.' ORDER BY idGamer');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $places[] = new Place($donnees);
        }
        
        return $Places;
    }
    
    
    public function getPlacesFromIdGamer($idGamer){
        $Places = [];
        
        $q = $this->_db->query('SELECT idGamer, idTypePlace, valide FROM Place WHERE idGamer = '.$idGamer.' ORDER BY idTypePlace');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Places[] = new Place($donnees);
        }
        
        return $Places;
    }
    
    public function getPlaces(){
        $Places = [];
        
        $q = $this->_db->query('SELECT idGamer, idTypePlace, valide FROM Place ORDER BY idGamer');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Places[] = new Place($donnees);
        }
        
        return $Places;
    }
    
    public function update(Place $place)
    {
        $q = $this->_db->prepare('UPDATE Place SET valide = :valide WHERE idGamer = :idGamer AND idTypePlace = :idTypePlace');
        $q->bindValue(':idGamer', $place->getIdGamer(), PDO::PARAM_INT);
        $q->bindValue(':idTypePlace', $place->getIdTypePlace(), PDO::PARAM_INT);
        $q->bindValue(':valide', $place->getValide(), PDO::PARAM_BOOL);
        $q->execute();
    }
    
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
    
}
?>