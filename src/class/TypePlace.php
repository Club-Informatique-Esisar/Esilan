<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

class User 
{
	private $idTypePlace;  // integer PK
	
	private $prix;         // integer
	private $nomType;      // string
	private $maxPlace;     // integer
	private $idLAN;        // integer FK
	
	
	// Constructeur
	function __construct(){
	}
	
	// ------------------------------ GETTEURS
	
    /**
     * @return integer
     */
    public function getIdGamer()
    {
        return $this->idGamer;
    }

    /**
     * @return integer
     */
    public function getIdTypePlace()
    {
        return $this->idTypePlace;
    }

    /**
     * @return boolean
     */
    public function getValide()
    {
        return $this->valide;
    }
    
    /**
     * @return integer
     */
    public function getIdLAN()
    {
        return $this->idLAN;
    }
    
    
    
    // ------------------------------ SETTEURS
    
    /**
     * @param integer $idGamer
     */
    public function setIdGamer($idGamer)
    {
        $this->idGamer = $idGamer;
    }

    /**
     * @param integer $idTypePlace
     */
    public function setIdTypePlace($idTypePlace)
    {
        $this->idTypePlace = $idTypePlace;
    }

    /**
     * @param boolean $valide
     */
    public function setValide($valide)
    {
        $this->valide = $valide;
    }

    /**
     * @param integer $idLAN
     */
    public function setValide($idLAN)
    {
        $this->idLAN = $idLAN;
    }
	
}

?>