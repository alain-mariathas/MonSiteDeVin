<?php include("test_connexion.php"); ?>
<?php include("head.php"); ?>
<html>

<?php include("post_bdd_conn.php"); ?>
    <body>
    <?php include("header.php"); ?>      
        
         <div id="bloc_search">
        <h3>Recherche</h3>
        <div class="divider">
        </div>
             
          <form id="form_search">
               <div class="row">
                <div class="input-field col s4">
                  <input id="SearchName" type="text">
                  <label for="SearchName">Nom</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s4">
                    <p>Années</p>
                    </div>
                  <div id="slider_an" class="col s4">
                  </div>
              </div>

                <div class="row">
                    
                    <div id="couleur_boxes" class="input-field col s4">
                        <p>Couleur</p>
                    <p>
                      <input type="checkbox" class="filled-in" id="rouge"/>
                      <label for="rouge">Rouge</label>
                    </p>

                    <p>
                      <input type="checkbox" class="filled-in" id="blanc"/>
                      <label for="blanc">Blanc</label>
                    </p>

                    <p>
                      <input type="checkbox" class="filled-in" id="rose"/>
                      <label for="rose">Rose</label>
                    </p>
                        
                    </div>
                  </div>
                  
              <div class="row">
                    <div class="input-field col s4">
                          <select multiple>
                          <option value="" disabled selected>Choisissez vos régions</option>
                          <option value="1">Bordeaux</option>
                          <option value="2">Languedoc</option>
                          <option value="3">Rhône</option>
                        </select>
                        <label>Régions</label>
                    </div>
                  </div>

            <div class="row">
              <div class="input-field center-align col s4">
              <input style="text-align:center"  type="submit" class="red lighten-1 pulse btn" value="valider">
            </div>
            </div>
        </form>
            </div> 
        
      <div id="vinebody" class="container main">
        <h3>Vin</h3>
        <div class="divider"></div>

          <div id="bloc_mainVine">
              
             <!-- LISTE DES VINS --> 
              <div id="list">
                    <table class="centered highlight">
                        <thead>
                          <tr>
                              <th>Nom</th>
                              <th>Domaine</th>
                              <th>Région</th>
                              <th>Couleur</th>
                              <th>Année</th>
                              <th> </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php
                            //TODO Requete affichage vins
                            $vins = $bdd->query('SELECT  v.vin_id, v.vin_nom, v.vin_couleur, v.vin_annee, v.vin_description, r.region_name, d.dom_name FROM vins v join domaines d ON v.domaine_id = d.dom_id JOIN regions r ON d.region_id = r.region_id;'); 
                            
                            while ($donnee = $vins->fetch())
                            {	
                            ?>
                            <tr>
                            <td><?php echo $donnee['vin_nom']; ?></td>
                            <td><?php echo $donnee['dom_name']; ?></td>
                            <td><?php echo $donnee['region_name']; ?></td>
                            <td><?php echo $donnee['vin_couleur']; ?></td>
                            <td><?php echo $donnee['vin_annee']; ?></td>
                            <td><button class="btn-floating btn-flat waves-effect waves-light btn-small" onclick="$('#card_vin<?php echo $donnee['vin_id']; ?>').removeClass('hide'); $('tr').hide('slow'); $('thead').hide('slow');"><i style="color:#ef9a9a" class="material-icons tiny">add</i></button></td>
                          </tr>
                                          <!-- FICHES DES VINS --> 
                     <div id="card_vin<?php echo $donnee['vin_id']; ?>" style="margin-top:5%; margin-bottom:10%" class="hoverable hide card large">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="" src="img/vin_card.jpg">
                        </div>
                        <div class="card-content">
                          <span class="card-title grey-text text-darken-4"><?php echo $donnee['vin_nom']; ?><br><h6><?php echo $donnee['vin_annee']; ?></h6></span>
                            <p><a class="btn-floating btn-flat waves-effect waves-light btn-small" href="#"><i style="color:#ef9a9a" class="activator material-icons">subject</i></a>
                                <a class="btn-floating btn-flat waves-effect waves-light btn-small" target="_blank" href="pdf.php"><i style="color:#ef9a9a" class="material-icons">print</i></a>
                            <button class="btn-floating btn-flat waves-effect waves-light btn-small" href="#" onclick="$('#card_vin<?php echo $donnee['vin_id']; ?>').addClass('hide'); $('tr').show('slow'); $('thead').show('slow');"><i style="color:#ef9a9a" class="material-icons bottom">close</i></button></p>
                        </div>
                        <div class="card-reveal">
                          <span class="card-title grey-text text-darken-4"><?php echo $donnee['vin_nom']; ?><i class="material-icons right">close</i></span>
                          <p><?php echo $donnee['vin_description']; ?></p>
                        </div>
                      </div>
                            
                          <?php
                            }
                            $vins->closeCursor();
                            ?>
                        </tbody>
                    </table>  
              </div>
              

        </div>


      </div>
        
  <?php include("footer.php"); ?>
       </body>

</html>
