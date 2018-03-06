<?php
/************************************************************
 * Definition des constantes / tableaux et variables
 *************************************************************/
include_once '../manager/DAO.php';

// Constantes
define('TARGET', '../media/');    // Repertoire cible
define('MAX_SIZE', 100000);    // Taille max en octets du fichier

// Tableaux de donnees
$tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
$infosImg = array();

// Variables
$extension = '';
$message = '';
$nomImage = '';

/************************************************************
 * Creation du repertoire cible si inexistant
 *************************************************************/
if( !is_dir(TARGET) ) {
    if( !mkdir(TARGET, 0755) ) {
        exit('Erreur : le r�pertoire cible ne peut-�tre cr�� ! V�rifiez que vous diposiez des droits suffisants pour le faire ou cr�ez le manuellement !');
    }
}

/************************************************************
 * Script d'upload
 *************************************************************/
$noError = false;
if(!empty($_POST))
{
    // On verifie si le champ est rempli
    if( !empty($_FILES['fichier']['name']) )
    {
        // Recuperation de l'extension du fichier
        $extension  = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
        
        // On verifie l'extension du fichier
        if(in_array(strtolower($extension),$tabExt))
        {
            // On recupere les dimensions du fichier
            $infosImg = getimagesize($_FILES['fichier']['tmp_name']);
            
            // On verifie le type de l'image
            if($infosImg[2] >= 1 && $infosImg[2] <= 14)
            {
                    // Parcours du tableau d'erreurs
                    if(isset($_FILES['fichier']['error'])
                        && UPLOAD_ERR_OK === $_FILES['fichier']['error'])
                    {
                        // On renomme le fichier
                        $nomImage = md5(uniqid()) .'.'. $extension;
                        
                        // Si c'est OK, on teste l'upload
                        if(move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET.$nomImage))
                        {
                            $message = 'Upload r�ussi !';
                            $noError = true;
                        }
                        else
                        {
                            // Sinon on affiche une erreur systeme
                            $message = 'Probl�me lors de l\'upload !';
                        }
                    }
                    else
                    {
                        $message = 'Une erreur interne a emp�ch� l\'uplaod de l\'image';
                    }
            }
            else
            {
                // Sinon erreur sur le type de l'image
                $message = 'Le fichier � uploader n\'est pas une image !';
            }
        }
        else
        {
            // Sinon on affiche une erreur pour l'extension
            $message = 'L\'extension du fichier est incorrecte !';
        }
    }
    else
    {
        // Sinon on affiche une erreur pour le champ vide
        $message = 'Veuillez remplir le formulaire svp !';
    }
}

if ($noError){
    $imgLAN = $nomImage;
    $nomImage = $_POST['nomLAN'];
    $dateDebut = $_POST['dateDebut'].' '.$_POST['heureDebut'];
    $dateFin = $_POST['dateFin'].' '.$_POST['heureFin'];
    $descLan = $_POST['descLan'];
    $nomLAN = $_POST['nomLan'];
    
    $newLAN = new LAN();    
    $newLAN->setImgLAN($imgLAN);
    $newLAN->setDateDebut($dateDebut);
    $newLAN->setDateFin($dateFin);
    $newLAN->setDescLAN($descLAN);
    $newLAN->setNomLAN($nomLAN);
    
    $DAO = new DAO();
    $DAO->insertLAN($lan);
    
}



include '../view/addLan.view.php';
?>