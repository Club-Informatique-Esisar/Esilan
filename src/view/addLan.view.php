<!DOCTYPE html>

<html>
  <head>
    <title>Ajouter un EsiLAN !</title>
    <link rel="stylesheet" type="text/css" href="">
     <meta charset="UTF-8"> 
  </head>
  <body>
   <form enctype="multipart/form-data" action="addLAN.php" method="post">
    <fieldset>
        <legend>Formulaire</legend>
       	  <p>
       	  	Nom de la LAN :
       	  	<input type="text" name="nomLAN">
       	  </p>
       	  <p>
       	  	Date début :
       	  	<input type="date" name="dateDebut" value="<?=date("Y-m-j")?>">
       	  	<input type="time" name="heureDebut" value="19:00">
       	  </p>
       	  <p>
       	  	Date fin :
       	  	<input type="date" name="dateFin" value="<?=date("Y-m-j")?>">
       	  	<input type="time" name="heureFin" value="19:00">
       	  </p>
       	  
       	  <p>
       	  	 <textarea name="descLAN" rows="10" cols="30">Description de la LAN.</textarea> 
       	  </p>
          <p>
            <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Affiche :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input name="imgLAN" type="file" id="fichier_a_uploader" />
         </p>
         <p>
            <input type="submit" name="submit" value="Uploader" />
         </p>
      </fieldset>
    </form>
  </body>
</html>