<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<?php include("head.php"); ?>
    <body>
    <?php include("header.php");
    include("post_bdd_conn.php");
    include("test_connexion.php");
     ?>
     
     <div class="container main">
     <div id="bloc_connexion" class="center-align" style="top:250px">
         <h3>Ajout d'un domaine</h3>
     <form name="form_conn" action="post_add_dom.php" method="post">
     
     <div class="divider"></div>
      
        <div class="row">
                <div class="input-field col s12">
                  <input name="name" id="name" type="text">
                  <label for="name">Nom du domaine</label>
                </div>
                </div>
        <div class="row">
                <div class="input-field col s12">
                  <input name="adresse" id="adresse" type="text">
                  <label for="adresse">Adresse</label>
                </div>
        </div>
        
        <div class="row">
                <div class="input-field col s12">
                <select name="region">
                  <option value="" disabled selected>Choisissez vos régions</option>
                          <?php
                            $rep=$bdd->query('SELECT region_id, region_name FROM regions;'); 
                                while($donnees = $rep->fetch())
                                    {
                                        echo "<option value=\"".$donnees['region_id']."\">".$donnees['region_name']."</option>";
                                    }
                            $rep->closeCursor();
                          ?>
                        </select>
          </div>
        </div>
        <div class="row">
              <div class="input-field col s12">
              <button action="post_add_dom.php" style="text-align:center" type="submit" class="red lighten-1 pulse btn" value="valider">Valider</button>
        </div> 
        
      </div>
     
     </form>
     </div> 
     </div>
    <?php include("footer.php"); ?>
    </body>
</html>
