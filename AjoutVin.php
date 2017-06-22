<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<?php 
include("head.php");
include_once 'post_bdd_conn.php';
 ?>
    <body>
    <?php include("header.php");
    //include("user_auth.php")
     ?>
     <form method="post" action="RecupDonnee_AjoutVin.php">
     <div class="container main">
     <div id="bloc_connexion" class="center-align" style="top:250px">
         <h3>Ajout de Vin</h3>
     <form id="form_conn" name="form_conn" action="post_connexion.php" method="post">
     
     <div class="divider"></div>
      
        <div class="row">
                <div class="input-field col s4">
                  <input name="Name" id="VineNom" type="text">
                  <label for="VineNom">Nom</label>
                </div>

		<div class="input-field col s4">
                	<select name="Couleur de vin" method="post">
                    	     <option value="Rouge">Rouge</option>
                             <option value="Blanc">Blanc</option>
			     <option value="Rose">Rose</option>
                 	</select>
                 	<label for="VineCouleur">Couleur du vin</label>
                 </div>
        </div>
        
        <div class="row">
                <div class="input-field col s4">
                  <input name="Year" id="VineAnnee" type="text">
                  <label for="VineAnnee">Annee</label>
                </div>
        </div>
        
        <div class="row">
		<div class="input-field col s12">
		<select name="DomaineName" method="post">
		<option value="" disabled selected>Choisissez le domaine</option>
                          <?php
                            $rep=$bdd->query('SELECT * FROM domaines;'); 
                                while($donnees = $rep->fetch())
                                    {
                                        echo "<option value=\"".$donnees['dom_id']."\">".$donnees['dom_name']."</option>";
                                    }
                            $rep->closeCursor();
			?>
		</select>
		</div>
        </div>
        
        
        <div class="row">
                <div class="input-field col s12">
                  <textarea id="DescriptionDuVin" class="materialize-textarea"></textarea>
                  <label for="DescriptionDuVin">Description du Vin</label>
                </div>
        </div>
        
        <div class="row">
              <div class="input-field col s12">
              <input for="form_conn" style="text-align:center" type="submit" class="red lighten-1 pulse btn" value="valider"/>
        </div> 
        
      </div>
     
     </form>
     </div> 
     </div>
    <?php include("footer.php"); ?>
    </body>
</html>
