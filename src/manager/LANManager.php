<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

include_once '../class/LAN.php';

/*
private $idLAN;        // integer PK

private $nomLAN;       // string
private $descLAN;      // string
private $imgLAN;       // string
private $dateDebut;    // datetime
private $dateFin;      // datetime
*/

class LANManager 
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
        $req = $this->_db->exec("CREATE TABLE `LAN` (
            `idLAN` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
            `nomLAN` TEXT NOT NULL ,
            `descLAN` TEXT NOT NULL,
            `imgLAN` TEXT NOT NULL ,
            `dateDebut` DATETIME NOT NULL ,
            `dateFin` DATETIME NOT NULL)");
    }
    
    public function add(LAN $lan)
    {
        $q = $this->_db->prepare('INSERT INTO LAN(nomLAN, descLAN, imgLAN, dateDebut, dateFin) VALUES(:nomLAN, :descLAN, :imgLAN, :dateDebut, :dateFin)');
        
        $q->bindValue(':nomLAN', $lan->getNomLAN(), PDO::PARAM_STR);
        $q->bindValue(':descLAN', $lan->getDescLAN(), PDO::PARAM_STR);
        $q->bindValue(':imgLAN', $lan->getImgLAN(), PDO::PARAM_STR);
        $q->bindValue(':dateDebut', $lan->getDateDebut());
        $q->bindValue(':dateFin', $lan->getDateFin());
        
        $q->execute();
    }
    
    public function delete(LAN $LAN)
    {
        $this->_db->exec('DELETE FROM LAN WHERE id = '.$LAN->getIdLAN());
    }
    
    public function get($id)
    {
        $id = (int) $id;
        
        $q = $this->_db->query('SELECT idLAN, nomLAN, descLAN, imgLAN FROM LAN WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        
        return new LAN($donnees);
    }
    
    public function getLANs()
    {
        $lans = [];
        
        $q = $this->_db->query('SELECT idLAN, nomLAN, descLAN, imgLAN, dateDebut, dateFin FROM LAN ORDER BY nomLAN');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $lans[] = new LAN($donnees);
        }
        
        return $lans;
    }
    
    public function update(LAN $LAN)
    {
        $q = $this->_db->prepare('UPDATE LAN SET nomLAN = :nomLAN, descLAN = :descLAN, imgLAN = :imgLAN, dateDebut := :dateDebut,'.
                                 'dateFin = :dateFin WHERE idLAN = :idLAN');
        
        $q->bindValue(':nomLAN', $LAN->getNomLAN(), PDO::PARAM_STR);
        $q->bindValue(':descLAN', $LAN->getDescLAN(), PDO::PARAM_STR);
        $q->bindValue(':imgLAN', $LAN->getImgLAN(), PDO::PARAM_STR);
        $q->bindValue(':dateDebut', $LAN->getDateDebut());
        $q->bindValue(':dateFin', $LAN->getDateFin());
        $q->bindValue(':idGamer', $LAN->getIdLAN(), PDO::PARAM_INT);
        
        
        $q->execute();
    }

}

?>