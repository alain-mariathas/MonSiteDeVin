<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<?php include("head.php"); ?>
    <body>
    <?php include("header_index.php");
    //include("user_auth.php")
     ?>
     
     <div class="container main">
     <div id="bloc_AjoutVin" class="center-align" style="top:250px">
         <h3>Ajout de Vin</h3>
     <form id="form_conn" name="form_conn" action="post_connexion.php" method="post">
     
     <div class="divider"></div>
      
        <div class="row">
                <div class="input-field col s4">
                  <input name="Name" id="VineNom" type="text">
                  <label for="VineNom">Nom</label>
                </div>
                <div class="input-field col s4">
                  <input name="Color" id="VineCouleur" type="text">
                  <label for="VineCouleur">Couleur</label>
                </div>
        </div>
        
        <div class="row">
                <div class="input-field col s4">
                  <input name="Year" id="VineAnnee" type="text">
                  <label for="VineAnnee">Annee</label>
                </div>
        </div>
        
        <div class="row">
                <div class="input-field col s4">
                  <input name="DomaineName" id="VineDomaineNom" type="text">
                  <label for="VineDomaineNom">Nom du Domaine</label>
                </div>
                
                <div class="input-field col s4">
                  <input name="DomaineAdresse" id="VineDomaineAdresse" type="text">
                  <label for="VineDomaineAdresse">Adresse du Domaine</label>
                </div>
        </div>
        
        <div class="row">
                <div class="input-field col s4">
                  <input name="RegionName" id="VineRegion" type="text">
                  <label for="VineRegion">Nom de la Region</label>
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
