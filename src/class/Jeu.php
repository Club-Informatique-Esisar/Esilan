<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

class Jeu 
{
	private $idJeu;        // integer PK
	private $nomJeu;       // string
	private $descJeu; 	   // string
	private $imgJeu;       // string
	
	
	// Constructeur
	function __construct($data){
	    if ($data == NULL){
	        
	    } else {
	        $this->setIdJeu($data['idJeu']);
	        $this->setDescJeu($data['descJeu']);
	        $this->setImg($data['imgJeu']);
	        $this->setNomJeu($data['nomjeu']);
	    }
	}
	
	// ------------------------------ GETTEURS
	
	/**
     * @return integer
     */
    public function getIdJeu()
    {
        return $this->idJeu;
    }

    /**
     * @return string
     */
    public function getNomJeu()
    {
        return $this->nomJeu;
    }

    /**
     * @return string
     */
    public function getDescJeu()
    {
        return $this->descJeu;
    }

    /**
     * @return string
     */
    public function getImgJeu()
    {
        return $this->imgJeu;
    }
    
    // ------------------------------ SETTEURS

    /**
     * @param string $idJeu
     */
    public function setIdJeu($idJeu)
    {
        $this->idJeu = $idJeu;
    }

    /**
     * @param string $name
     */
    public function setNomJeu($name)
    {
        $this->nomJeu = $nomJeu;
    }

    /**
     * @param string $desc
     */
    public function setDescJeu($descJeu)
    {
        $this->descJeu = $descJeu;
    }

    /**
     * @param string $img
     */
    public function setImg($imgJeu)
    {
        $this->imgJeu = $imgJeu;
    }

	

}

?>