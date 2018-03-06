<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 05/03/2018
 * Version: 1.0
 ************************************************/

include_once '../class/Gamer.php';

/*
private $idGamer;      // int PK
private $nomGamer;     // string
private $promo;        // string
*/

class GamerManager 
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
        $req = $this->_db->exec("CREATE TABLE `Gamer` (
            `idGamer` INT NOT NULL PRIMARY KEY ,
            `nomGamer` TEXT NOT NULL ,
            `promo` TEXT NOT NULL)");
    }
    
    public function add(Gamer $gamer)
    {
        $q = $this->_db->prepare('INSERT INTO Gamer(nomGamer, promo) VALUES(:nomGamer, :promo)');
        
        $q->bindValue(':nomGamer', $gamer->getNomGamer());
        $q->bindValue(':promo', $gamer->getPromo());

        
        $q->execute();
    }
    
    public function delete(Gamer $gamer)
    {
        $this->_db->exec('DELETE FROM gamer WHERE id = '.$gamer->getIdGamer());
    }
    
    public function get($id)
    {
        $id = (int) $id;
        
        $q = $this->_db->query('SELECT idGamer, nomGamer, promo FROM gamer WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        
        return new Gamer($donnees);
    }
    
    public function getGamers()
    {
        $gamers = [];
        
        $q = $this->_db->query('SELECT idGamer, nomGamer, promo FROM gamer ORDER BY nomGamer');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $gamers[] = new Gamer($donnees);
        }
        
        return $gamers;
    }
    
    public function update(Gamer $perso)
    {
        $q = $this->_db->prepare('UPDATE gamer SET nomGamer = :nomGamer, promo = :promo WHERE idGamer = :idGamer');
        
        $q->bindValue(':nomGamer', $perso->forcePerso(), PDO::PARAM_STR);
        $q->bindValue(':promo', $perso->degats(), PDO::PARAM_STR);
        $q->bindValue(':idGamer', $perso->id(), PDO::PARAM_INT);
        
        $q->execute();
    }
    

}

?>