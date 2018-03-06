<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

include_once '../class/Tournoi.php';


 /*
private $idLAN;       // integer PK FK
private $idJeu;       // integer PK FK

private $duree;       // float
private $heureDebut;  // float
*/

class TournoiManager 
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
    
    /* TODO Pass duree and heureDebut to Datetime */
    private $todo = false;
    public function createTable(){
        while ($this->todo){
            $req = $this->_db->exec("CREATE TABLE `Tournoi` (
            `idLAN` INT NOT NULL ,
            `idJeu` INT NOT NULL ,
            `duree` INT NOT NULL ,
            `heureDebut` INT NOT NULL ,
            CONSTRAINT FK_LANTournoi FOREIGN KEY (idLAN)
            REFERENCES LAN(idLAN),
            CONSTRAINT FK_JeuTournoi FOREIGN KEY (idJeu)
            REFERENCES Jeu(idJeu),
            CONSTRAINT PK_Participation PRIMARY KEY (idLAN, idJeu))");
        }
    }
    
    public function add(Tournoi $tournoi)
    {
        $q = $this->_db->prepare('INSERT INTO Tournoi(idLan, idJeu, duree, heureDebut) VALUES(:idLan, :idJeu, :duree, :heureDebut)');
        
        $q->bindValue(':idLan', $tournoi->getIdLAN(), PDO::PARAM_INT);
        $q->bindValue(':idJeu', $tournoi->getIdJeu(), PDO::PARAM_INT);
        $q->bindValue(':duree', $tournoi->getDuree());
        $q->bindValue(':heureDebut', $tournoi->getHeureDebut());
        
        $q->execute();
    }
    
    public function delete(Tournoi $tournoi)
    {
        $this->_db->exec('DELETE FROM Tournoi WHERE idLan = '.$tournoi->getIdLAN().' AND idJeu = '.$tournoi->getIdJeu());
    }
    
    public function get($idLAN, $idJeu){
        $idLAN = (int) $idLAN;
        $idJeu = (int) $idJeu;
        
        $q = $this->_db->query('SELECT idLan, idJeu, duree, heureDebut FROM Tournoi WHERE idLan = '.$idLAN.'AND idJeu = '.$idJeu);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        
        return new Tournoi($donnees);
    }
    
    
    public function getTournoisFromIdLAN($idLAN){
        $tournois = [];
        
        $q = $this->_db->query('SELECT idLan, idJeu, duree, heureDebut FROM Tournoi WHERE idLan = '.$idLAN.' ORDER BY idJeu');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $tournois[] = new Tournoi($donnees);
        }
        
        return $tournois;
    }
    
    
    public function getTournoisFromIdJeu($idJeu){
        $tournois = [];
        
        $q = $this->_db->query('SELECT idLan, idJeu, duree, heureDebut FROM Tournoi WHERE idJeu = '.$idJeu.' ORDER BY idLAN');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $tournois[] = new Tournoi($donnees);
        }
        
        return $tournois;
    }
    
    public function getTournois(){
        $tournois = [];
        
        $q = $this->_db->query('SELECT idLan, idJeu, duree, heureDebut FROM Tournoi ORDER BY idLAN');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $tournois[] = new Tournoi($donnees);
        }
        
        return $tournois;
    }
    
    public function update(Tournoi $tournoi)
    {
        $q = $this->_db->prepare('UPDATE Tournoi SET duree = :duree, heureDebut = :heureDebut WHERE idJeu = :idJeu AND idLAN = :idLAN');
        $q->bindValue(':duree', $tournoi->getDuree());
        $q->bindValue(':heureDebut', $tournoi->getHeureDebut());
        $q->bindValue(':idJeu', $tournoi->getIdJeu(), PDO::PARAM_INT);
        $q->bindValue(':idLAN', $tournoi->getIdLAN(), PDO::PARAM_INT);
        $q->execute();
    }
   
    
}
?>