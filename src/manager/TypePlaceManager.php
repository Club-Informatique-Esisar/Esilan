<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

include_once '../class/TypePlace.php';

/*
	private $idTypePlace;  // integer PK
	
	private $prix;         // integer
	private $nomType;      // string
	private $maxPlace;     // integer
	private $idLAN;        // integer FK
*/

class TypePlaceManager 
{
    private $_db; // Instance de PDO
    
    public function __construct($db)
    {
        $this->setDb($db);
    }
    
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
    
    public function createTable(){
        $req = $this->_db->exec("CREATE TABLE `TypePlace` (
            `idTypePlace` INT NOT NULL PRIMARY KEY,
            `prix` INT NOT NULL ,
            `nomType` TEXT NOT NULL ,
            `maxPlace` INT NOT NULL ,
            `idLAN` INT NOT NULL ,
            CONSTRAINT FK_LanTypePlace FOREIGN KEY (idLAN)
            REFERENCES Lan(idLAN))");
    }
    
    public function add(TypePlace $typePlace)
    {
        $q = $this->_db->prepare('INSERT INTO TypePlace(prix, nomType, maxPlace, idLAN) VALUES(:prix, :nomType, :maxPlace, :idLAN)');
        
        $q->bindValue(':prix', $typePlace->getPrix());
        $q->bindValue(':nomType', $typePlace->getNomType());
        $q->bindValue(':maxPlace', $typePlace->getMaxPlace());
        $q->bindValue(':idLAN', $typePlace->getIdLAN());
        
        $q->execute();
    }
    
    public function delete(TypePlace $typePlace)
    {
        $this->_db->exec('DELETE FROM TypePlace WHERE idTypePlace = '.$typePlace->getIdTypePlace());
    }
    
    public function get($idTypePlace){
        $idTypePlace = (int) $idTypePlace;
        
        $q = $this->_db->query('SELECT idTypePlace, prix, nomType, maxPlace, idLAN FROM TypePlace WHERE idTypePlace = '.$idTypePlace);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        
        return new TypePlace($donnees);
    }
    
    
    public function getTypePlacesFromIdLAN($idLAN){
        $typePlaces = [];
        
        $q = $this->_db->query('SELECT idTypePlace, prix, nomType, maxPlace, idLAN FROM TypePlace WHERE idLAN = '.$idLAN.' ORDER BY idTypePlace');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $typePlaces[] = new TypePlace($donnees);
        }
        
        return $typePlaces;
    }
    
    public function getTypePlaces(){
        $typePlaces = [];
        
        $q = $this->_db->query('SELECT idTypePlace, prix, nomType, maxPlace, idLAN FROM TypePlace ORDER BY idTypePlace');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $typePlaces[] = new TypePlace($donnees);
        }
        
        return $typePlaces;
    }
    
    public function update(TypePlace $typePlace)
    {
        $q = $this->_db->prepare('UPDATE TypePlace SET prix = :prix, nomType = :nomType, maxPlace = :maxPlace, idLAN = :idLAN WHERE idTypePlace = :idTypePlace');
        $q->bindValue(':prix', $typePlace->getPrix(), PDO::PARAM_INT);
        $q->bindValue(':nomType', $typePlace->getNomType(), PDO::PARAM_INT);
        $q->bindValue(':maxPlace', $typePlace->getMaxPlace());
        $q->bindValue(':idLAN', $typePlace->getIdLAN());
        $q->bindValue(':idTypePlace', $typePlace->getIdTypePlace());
        
        $q->execute();
    }
    
    
}
?>