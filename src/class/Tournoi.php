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
	
	private $durée;       // float
	private $heureDebut;  // float
	
	
	// ------------------------------ CONSTRUCTOR
	function __construct(){
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
     * @return float
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * @return float
     */
    public function getDurée()
    {
        return $this->durée;
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
    public function setIdTournoi($idJeu)
    {
        $this->idJeu = $idJeu;
    }

    /**
     * @param float $heureDebut
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;
    }

    /**
     * @param float $durée
     */
    public function setDurée($durée)
    {
        $this->durée = $durée;
    }
    



	
	
	
}

?>