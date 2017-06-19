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
             
          <form action="#!" id="form_search" method="POST">
               <div class="row">
                <div class="input-field col s4">
                  <input name="filtre_nom" id="SearchName" type="text">
                  <label for="SearchName">Nom</label>
                </div>
              </div>
              

              <div class="row">
              <div class="input-field col s4">
                                <p>Années<br>
                  De </p>
                  <input style="display:inline-block" name="filtre_annee_1" id="range1" type="range" value="1920" min="1920" max="2017">
                  <i style="display:inline-block" class="material-icons" onclick="$('#annee2').removeClass('hide'); document.getElementById('range2').setAttribute('min',document.getElementById('range1').value);">add</i>
                  </div>
              </div>
              <div class="row">
                <div id="annee2" class="input-field col s4 hide">
                  <p>A</p>
                  <input id="range2" name="filtre_annee_2" type="range" max="2017">
                  </div>
              </div>
              
                <div class="row">
                    
                    <div id="couleur_boxes" class="input-field col s4">
                        <p>Couleur</p>
                    <p>
                      <input type="checkbox" class="filled-in" id="rouge" name="rouge"/>
                      <label for="rouge">Rouge</label>
                    </p>

                    <p>
                      <input type="checkbox" class="filled-in" id="blanc" name="blanc"/>
                      <label for="blanc">Blanc</label>
                    </p>

                    <p>
                      <input type="checkbox" class="filled-in" id="rose" name="rose"/>
                      <label for="rose">Rose</label>
                    </p>
                        
                    </div>
                  </div>
                  
              <div class="row">
                    <div class="input-field col s4">
                                            <p>Régions</p>
                          <select name="filtre_region" multiple>
                          <option value="" disabled selected>Choisissez vos régions</option>
                          <?php
                            $rep=$bdd->query('SELECT * FROM regions;'); 
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
                          $request='SELECT  v.vin_id, v.vin_nom, v.vin_couleur, v.vin_annee, v.vin_description, r.region_name, d.dom_name FROM vins v join domaines d ON v.domaine_id = d.dom_id JOIN regions r ON d.region_id = r.region_id ';
                          
                            if(isset($_POST['filtre_nom']) or isset($_POST['filtre_annee_1']) or isset($_POST['rose']) or isset($_POST['rouge']) or isset($_POST['blanc']) or isset($_PSOT['filtre_region']))
                            {
                              $request=$request."WHERE 1=1 ";
                              
                              if(isset($_POST['filtre_nom']))
                              {
                                $toreplace=array('\'', "\"","&"," ");
                                $nom=addslashes(str_replace($toreplace,"",$_POST['filtre_nom']));
                                $request=$request."AND UPPER(vin_nom) LIKE UPPER('%".$nom."%') ";
                              }

                              if(isset($_POST['filtre_annee_1']) and isset($_POST['filtre_annee_2']))
                              {
                                $deb=$_POST['filtre_annee_1'];
                                $request=$request."AND vin_annee>=".$deb." ";
                                $fin=2017;
                                if(isset($_POST['filtre_annee_2']) and $_POST['filtre_annee_2']>$deb)
                                {
                                  $fin=$_POST['filtre_annee_2'];
                                  
                                  $request=$request."AND vin_annee<=".$fin." ";
                                }
                              }
                              else
                              {
                                $request=$request."AND vin_annee BETWEEN 1940 AND 2017 ";
                              }
                              
                              if(isset($_POST['rose']) or isset($_POST['rouge']) or isset($_POST['blanc']))
                              {
                                $request=$request."AND vin_couleur IN(";
                                
                                  if(isset($_POST['rose']))
                                  {
                                    $request=$request."'Rose'";
                                    if(isset($_POST['rouge']) or isset($_POST['blanc']))
                                    {
                                      $request=$request.",";
                                    }
                                  }
                                  if(isset($_POST['rouge']))
                                  {
                                    $request=$request."'Rouge'";
                                    if(isset($_POST['blanc']))
                                    {
                                      $request=$request.",";
                                    }
                                  }
                                  if(isset($_POST['blanc']))
                                  {
                                    $request=$request."'Blanc'";
                                  }
                              $request=$request.") ";
                            }
                            
                              //TODO : Terminer tous les filtres
                              if(isset($_POST['filtre_region']))
                                  {
                                    $_POST['filtre_region'];
                                  }
                          }
                            
                            $request=$request.";";
                            
                            $vins = $bdd->query($request);
                            
                            $nbr=$vins->rowCount();
                            if($nbr==0)
                            {
                              ?>
                                <script type="text/javascript">
                                $('thead').hide();
                                </script>
                              <?php
                              echo "<br><h3>Pas de résultats</h3>";
                            }
                            
                            else
                            {
                            while ($donnee = $vins->fetch())
                              {	
                              ?>
                              <tr>
                              <td><?php echo $donnee['vin_nom']; ?></td>
                              <td><?php echo $donnee['dom_name']; ?></td>
                              <td><?php echo $donnee['region_name']; ?></td>
                              <td><?php echo $donnee['vin_couleur']; ?></td>
                              <td><?php echo $donnee['vin_annee']; ?></td>
                              <td><button class="btn-floating btn-flat waves-effect waves-light btn-small" onclick="$('#card_vin<?php echo $donnee['vin_id']; ?>').removeClass('hide'); $('tr').hide(); $('thead').hide();"><i style="color:#ef9a9a" class="material-icons tiny">add</i></button></td>
                            </tr>
                                            <!-- FICHES DES VINS --> 
                               <div id="card_vin<?php echo $donnee['vin_id']; ?>" style="margin-top:5%; margin-bottom:10%" class="hoverable hide card large">
                                  <div class="card-image waves-effect waves-block waves-light">
                                      <img class="" src="img/vin_card.jpg">
                                  </div>
                                  <div class="card-content">
                                    <span class="card-title grey-text text-darken-4"><?php echo $donnee['vin_nom']; ?><br><h6><?php echo $donnee['vin_annee']; ?></h6></span>
                                      <p><a class="btn-floating btn-flat waves-effect waves-light btn-small" href="#"><i style="color:#ef9a9a" class="activator material-icons">subject</i></a>
                                          <form method="POST" action="pdf.php" target="_blank">
                                          <input type="hidden" name="nom_vin" value="<?php echo $donnee['vin_nom']; ?>"/>
                                          <input type="hidden" name="description_vin" value="<?php echo $donnee['vin_description']; ?>"/>
                                          <input type="hidden" name="annee_vin" value="<?php echo $donnee['vin_annee']; ?>"/>
                                          <input type="hidden" name="couleur_vin" value="<?php echo $donnee['vin_couleur']; ?>"/>
                                          <input type="hidden" name="region_vin" value="<?php echo $donnee['region_name']; ?>"/>
                                          <input type="hidden" name="domaine_vin" value="<?php echo $donnee['dom_name']; ?>"/>
                                          <button target="_blank" type="submit" class="btn-floating btn-flat waves-effect waves-light btn-small" target="_blank" action="pdf.php"><i style="color:#ef9a9a" class="material-icons">print</i></form></button>
                                      <a class="btn-floating btn-flat waves-effect waves-light btn-small" href="#" onclick="$('#card_vin<?php echo $donnee['vin_id']; ?>').addClass('hide'); $('tr').show('slow'); $('thead').show('slow');"><i style="color:#ef9a9a" class="material-icons bottom">close</i></a></p>
                                  </div>
                                  <div class="card-reveal">
                                    <span class="card-title grey-text text-darken-4"><?php echo $donnee['vin_nom']; ?><i class="material-icons right">close</i></span>
                                    <p><?php echo $donnee['vin_description']; ?></p>
                                  </div>
                                </div>
                              
                            <?php
                              }
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
