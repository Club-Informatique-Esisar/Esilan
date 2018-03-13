<?php

include_once '../manager/DAO.php';

$dao = new DAO();

$lans = $dao->getLANs();

$data = '<h1>LANs : </h1>';

foreach ($lans as $lan){
    $data .= '<div>';
    $data .= '<h2>'.$lan->getIdLAN().'-'.$lan->getNomLAN().'</h2>';
    $data .= '<img src="http://localhost/esilan/src/img/'.$lan->getImgLAN().'" />';
    $data .= '<p>'.$lan->getDescLAN().'</p>';
    $data .= '<p>'.$lan->getDateDebut().' - '.$lan->getDateFin().'</p>';
    $data .= '</div>';
    
}


include '../view/consulterLan.view.php';