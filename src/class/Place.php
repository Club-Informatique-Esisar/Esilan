<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

class Place 
{
	private $idGamer; 		 // integer PK FK
	private $idTypePlace; 	 // integer PK FK
	
	private $valide; 	     // boolean
	
	// Constructeur
	function __construct(){
	}
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


	
}

?>