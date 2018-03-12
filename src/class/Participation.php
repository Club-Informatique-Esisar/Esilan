<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

class Participation 
{
	private $idGamer; 		// integer PK FK 
	private $idTournoi; 	// integer PK FK

	
	// Constructeur
	function __construct($data){
	    if ($data == NULL){
	        
	    } else {
	        $this->setIdGamer($data['idGamer']);
	        $this->setIdTournoi($data['idTournoi']);
	    }
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
    public function getIdTournoi()
    {
        return $this->idTournoi;
    }

    /**
     * @param integer $idGamer
     */
    public function setIdGamer($idGamer)
    {
        $this->idGamer = $idGamer;
    }

    /**
     * @param integer $idTournoi
     */
    public function setIdTournoi($idTournoi)
    {
        $this->idTournoi = $idTournoi;
    }


	
}

?>