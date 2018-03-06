<!DOCTYPE html>

<html>
  <head>
    <title>Upload d'une image sur le serveur !</title>
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
       	  	<input type="date" name="dateDebut">
       	  	<input type="time" name="heureDebut">
       	  </p>
       	  <p>
       	  	Date fin :
       	  	<input type="date" name="dateFin">
       	  	<input type="time" name="heureFin">
       	  </p>
       	  
       	  <p>
       	  	 <textarea name="message" rows="10" cols="30">
Description de la LAN.
             </textarea> 
       	  </p>
          <p>
            <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Affiche :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000" />
            <input name="fichier" type="file" id="fichier_a_uploader" />
         </p>
         <p>
            <input type="submit" name="submit" value="Uploader" />
         </p>
      </fieldset>
    </form>
  </body>
</html>