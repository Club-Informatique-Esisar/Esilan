<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

class Tournoi 
{
	private $idLAN;       // integer PK FK
	private $idJeu;       // integer PK FK     
	
	private $dateDebut;       // DateTime
	private $dateFin;  // DateTime
	
	
	// ------------------------------ CONSTRUCTOR
	function __construct($data){
	    if ($data == NULL){
	        
	    } else {
	        $this->setIdLAN($data['idLAN']);
	        $this->setIdJeu($data['idJeu']);
	        $this->setDateDebut($data['dateDebut']);
	        $this->setDateFin($data['dateFin']);
	    }
	}
	
	
	// ------------------------------ GETTEURS

    /**
     * @return integer
     */
    public function getIdLAN()
    {
        return $this->idLAN;
    }

    /**
     * @return integer
     */
    public function getIdJeu()
    {
        return $this->idJEU;
    }

    /**
     * @return DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @return DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    
    // ------------------------------ SETTEURS
    
    /**
     * @param integer $idLAN
     */
    public function setIdLAN($idLAN)
    {
        $this->idLAN = $idLAN;
    }

    /**
     * @param integer $idJeu
     */
    public function setIdJeu($idJeu)
    {
        $this->idJeu = $idJeu;
    }

    /**
     * @param DateTime $heureDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @param DateTime $durée
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }
    



	
	
	
}

?>