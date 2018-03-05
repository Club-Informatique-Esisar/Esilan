<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

class TypePlace 
{
	private $idTypePlace;  // integer PK
	
	private $prix;         // integer
	private $nomType;      // string
	private $maxPlace;     // integer
	private $idLAN;        // integer FK
	
	
	// Constructeur
	function __construct(){
	}
	
	
    /**
     * @return integer
     */
    public function getIdTypePlace()
    {
        return $this->idTypePlace;
    }

    /**
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @return string
     */
    public function getNomType()
    {
        return $this->nomType;
    }

    /**
     * @return integer
     */
    public function getMaxPlace()
    {
        return $this->maxPlace;
    }

    /**
     * @return integer
     */
    public function getIdLAN()
    {
        return $this->idLAN;
    }

    
    // ------------------------------
    
    /**
     * @param integer $idTypePlace
     */
    public function setIdTypePlace($idTypePlace)
    {
        $this->idTypePlace = $idTypePlace;
    }

    /**
     * @param integer $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @param string $nomType
     */
    public function setNomType($nomType)
    {
        $this->nomType = $nomType;
    }

    /**
     * @param integer $maxPlace
     */
    public function setMaxPlace($maxPlace)
    {
        $this->maxPlace = $maxPlace;
    }

    /**
     * @param integer $idLAN
     */
    public function setIdLAN($idLAN)
    {
        $this->idLAN = $idLAN;
    }

	

	
}

?>