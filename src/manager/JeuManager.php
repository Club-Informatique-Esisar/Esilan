<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

include_once '../class/Jeu.php';

/*
private $idJeu;        // integer PK
private $nomJeu;       // string
private $descJeu; 	   // string
private $imgJeu;       // string
*/

class JeuManager 
{
    private $_db; // Instance de PDO
    
    public function __construct($db)
    {
        $this->setDb($db);
    }
    
    public function add(Jeu $jeu)
    {
        $q = $this->_db->prepare('INSERT INTO Jeu(nomJeu, descJeu, imgJeu) VALUES(:nomJeu, :descJeu, :imgJeu)');
        
        $q->bindValue(':nomJeu', $jeu->getNomJeu());
        $q->bindValue(':descJeu', $jeu->getDescJeu());
        $q->bindValue(':imgJeu', $jeu->getImgJeu());
        
        $q->execute();
    }
    
    public function delete(Jeu $jeu)
    {
        $this->_db->exec('DELETE FROM jeu WHERE id = '.$jeu->getIdJeu());
    }
    
    public function get($id)
    {
        $id = (int) $id;
        
        $q = $this->_db->query('SELECT idJeu, nomJeu, descJeu, imgJeu FROM Jeu WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        
        return new Jeu($donnees);
    }
    
    public function getJeux()
    {
        $jeux = [];
        
        $q = $this->_db->query('SELECT idJeu, nomJeu, descJeu, imgJeu FROM Jeu ORDER BY nomJeu');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $jeux[] = new Jeu($donnees);
        }
        
        return $jeux;
    }
    
    public function update(Jeu $jeu)
    {
        $q = $this->_db->prepare('UPDATE Jeu SET nomJeu = :nomJeu, descJeu = :descJeu, imgJeu = :imgJeu WHERE idJeu = :idJeu');
        
        $q->bindValue(':nomJeu', $jeu->getNomJeu(), PDO::PARAM_STR);
        $q->bindValue(':descJeu', $jeu->getDescJeu(), PDO::PARAM_STR);
        $q->bindValue(':imgJeu', $jeu->getImgJeu(), PDO::PARAM_STR);
        $q->bindValue(':idJeu', $jeu->getIdJeu(), PDO::PARAM_INT);
        
        $q->execute();
    }
    
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }	

}

?>