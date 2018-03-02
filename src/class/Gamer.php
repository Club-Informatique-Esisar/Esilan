<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

class Gamer 
{
	private $idGamer;      // int PK
	
	private $nomGamer;     // string
	private $promo;        // string

	
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
     * @return string
     */
    public function getNomGamer()
    {
        return $this->nomGamer;
    }

    /**
     * @return string
     */
    public function getPromo()
    {
        return $this->promo;
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
     * @param string $nom
     */
    public function setNomGamer($nomGamer)
    {
        $this->nomGamer = $nomGamer;
    }

    /**
     * @param string $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }
    
	

}

?>