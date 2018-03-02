<?php
/************************************************
 * Author: Corentin BERSOT
 * Mail: corentin.bersot@gmail.com
 * Date : 28/02/2018
 * Version: 1.0
 ************************************************/

class LAN 
{
	private $idLAN;        // integer PK
	
	private $nomLAN;       // string
	private $descLAN;      // string
	private $imgLAN;       // string
	private $dateDebut;    // datetime
	private $dateFin;      // datetime
	
	
	
	// Constructeur
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
     * @return string
     */
    public function getNomLAN()
    {
        return $this->nomLAN;
    }

    /**
     * @return string
     */
    public function getDescLAN()
    {
        return $this->descLAN;
    }

    /**
     * @return string
     */
    public function getImgLAN()
    {
        return $this->imgLAN;
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

    /**
     * @param integer $idLAN
     */
    public function setIdLAN($idLAN)
    {
        $this->idLAN = $idLAN;
    }

    /**
     * @param string $nomLAN
     */
    public function setNomLAN($nomLAN)
    {
        $this->nomLAN = $nomLAN;
    }

    /**
     * @param string $descLAN
     */
    public function setDescLAN($descLAN)
    {
        $this->descLAN = $descLAN;
    }

    /**
     * @param string $imgLAN
     */
    public function setImgLAN($imgLAN)
    {
        $this->imgLAN = $imgLAN;
    }

    /**
     * @param DateTime $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @param DateTime $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

	
	
	
	
}

?>