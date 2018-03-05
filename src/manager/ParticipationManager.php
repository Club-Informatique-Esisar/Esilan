<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

include_once '../class/Participation.php';

/*
 	private $idGamer; 		// integer PK FK 
	private $idTournoi; 	// integer PK FK
*/


class ParticipationManager 
{
    private $_db; // Instance de PDO
    
    public function __construct($db)
    {
        $this->setDb($db);
    }
    
    public function add(Participation $part)
    {
        $q = $this->_db->prepare('INSERT INTO Participation(idGamer, idTournoi) VALUES(:idGamer, :idTournoi)');
        
        $q->bindValue(':idGamer', $part->getIdGamer(), PDO::PARAM_INT);
        $q->bindValue(':idTournoi', $part->getIdTournoi(), PDO::PARAM_INT);
        
        $q->execute();
    }
    
//     public function delete(Participation $part)
//     {
//         $this->_db->exec('DELETE FROM Participation WHERE id = '.$Participation->getIdParticipation());
//     }
    
    public function get($idGamer, $idTournoi){
        $idGamer = (int) $idGamer;
        $idTournoi = (int) $idTournoi;
        
        $q = $this->_db->query('SELECT idGamer, idTournoi FROM Participation WHERE idGamer = '.$idGamer.'AND idTournoi = '.$idTournoi);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        
        return new Participation($donnees);
    }
    
    
    public function getParticipationsFromIdTournoi($idTournoi){
        $participations = [];
        
        $q = $this->_db->query('SELECT idGamer, idTournoi FROM Participation WHERE idTournoi = '.$idTournoi.' ORDER BY idGamer');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $participations[] = new Participation($donnees);
        }
        
        return $participations;
    }
    
    
    public function getParticipationsFromIdGamer($idGamer){
        $participations = [];
        
        $q = $this->_db->query('SELECT idGamer, idTournoi FROM Participation WHERE idGamer = '.$idGamer.' ORDER BY idTournoi');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $participations[] = new Participation($donnees);
        }
        
        return $participations;
    }
    
    public function getParticipations(){
        $participations = [];
        
        $q = $this->_db->query('SELECT idGamer, idTournoi FROM Participation ORDER BY idGamer');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $participations[] = new Participation($donnees);
        }
        
        return $participations;
    }
    
//     public function update(Participation $Participation)
//     {
//         $q = $this->_db->prepare('UPDATE Participation SET nomParticipation = :nomParticipation, descParticipation = :descParticipation, imgParticipation = :imgParticipation, dateDebut := :dateDebut,'.
//             'dateFin = :dateFin WHERE idParticipation = :idParticipation');
//         $q->bindValue(':nomParticipation', $Participation->getNomParticipation(), PDO::PARAM_STR);
//         $q->bindValue(':descParticipation', $Participation->getDescParticipation(), PDO::PARAM_STR);
//         $q->bindValue(':imgParticipation', $Participation->getImgParticipation(), PDO::PARAM_STR);
//         $q->bindValue(':dateDebut', $Participation->getDateDebut());
//         $q->bindValue(':dateFin', $Participation->getDateFin());
//         $q->bindValue(':idGamer', $Participation->getIdParticipation(), PDO::PARAM_INT);
//         $q->execute();
//     }
    
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
    
}

?>