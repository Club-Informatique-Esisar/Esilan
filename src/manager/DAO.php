<?php
include_once '../manager/GamerManager.php';
include_once '../manager/JeuManager.php';
include_once '../manager/LANManager.php';
include_once '../manager/ParticipationManager.php';
include_once '../manager/PlaceManager.php';
include_once '../manager/TournoiManager.php';
include_once '../manager/TypePlaceManager.php';


class DAO {
    
    private $db;
    
    function __construct(){
        $config = include('../config.php');
        try {
            $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['database'], $config['username'], $config['mdp']);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    function insertLAN(LAN $lan){
        $lanManager = new LANManager($this->db);
        $lanManager->add($lan);
    }
    
    function getLANs(){
        $lanManager = new LANManager($this->db);
        return $lanManager->getLANs();
    }
    
    function getLan($id){
        $lanManager = new LANManager($this->db);
        return $lanManager->get($id);
    }
    
    function createBDD(){
        $gamerManager = new GamerManager($this->db);
        $jeuManager = new JeuManager($this->db);
        $lanManager = new LANManager($this->db);
        $participationManager = new ParticipationManager($this->db);
        $placeManager = new PlaceManager($this->db);
        $tournoiManager = new TournoiManager($this->db);
        $typePlaceManager = new TypePlaceManager($this->db);
        
        $lanManager->createTable();
        $gamerManager->createTable();
        $jeuManager->createTable();
        $typePlaceManager->createTable();
        $placeManager->createTable();
        $participationManager->createTable();
        $tournoiManager->createTable();
        
        
        
    }
}





?>