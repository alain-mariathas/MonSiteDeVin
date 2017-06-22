<?php include("test_connexion.php"); ?>
<?php include("head.php"); ?>
<html>
   
<?php include("post_bdd_conn.php"); ?>
    <body >
    <?php include("header.php"); ?>  
    <main style="margin-top:3%">
         <div style="text-align:center" id="bloc_search">
        <h3>Recherche</h3>
        <div class="divider">
        </div>
             
          <form action="#!" method="POST">
               <div class="row">
                <div class="input-field col s5">
                  <input name="filtre_nom" id="SearchName" type="text">
                  <label for="SearchName">Nom</label>
                </div>
              </div>
              <div class="row">
              <div class="inline input-field col s5">
               Années de :
                  <input style="display:inline-block" name="filtre_annee_1" id="range1" type="range" value="1920" min="1920" max="2017" onmouseup="$('#annee2').removeClass('hide'); document.getElementById('range2').setAttribute('min',document.getElementById('range1').value);">
                  </div>
              </div>
              <div class="row">
                <div id="annee2" class="input-field col s5 hide inline">
                                    A <input id="range2" name="filtre_annee_2" type="range" max="2017">
                  </div>
              </div>
              
                <div class="row">
                    
                    <div id="couleur_boxes" class="input-field col s5">
                  Couleur
                    <p>
                      <input type="checkbox" class="filled-in" id="rouge" name="rouge"/>
                      <label for="rouge">Rouge</label>

                      <input type="checkbox" class="filled-in" id="blanc" name="blanc"/>
                      <label for="blanc">Blanc</label>

                      <input type="checkbox" class="filled-in" id="rose" name="rose"/>
                      <label for="rose">Rose</label>
                    </p>
                        
                    </div>
                  </div>
                  
              <div class="row">
                    <div class="input-field col s5">
                                            <p>Régions</p>
                          <select name="filtre_region">
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
              <div class="input-field center-align col s5">
              <input style="text-align:center"  type="submit" class="red lighten-1 pulse btn" value="valider">
            </div>
            </div>
            
            <div class="row">
              <div class="input-field center-align col s5">
              <a href="vinebody.php" style="text-align:center" class="red lighten-1 pulse btn">Réinitialiser</a>
            </div>
            </div>
        </form>
            </div> 
        
      <div style="height:100%" id="vinebody" class="main">
        <h3>Vins</h3>
        <div class="divider"></div>

          <div style="height:100%" id="bloc_mainVine">
              
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
                            
                              if(isset($_POST['filtre_region']))
                                  {
                                    $request=$request." AND (domaine_id = (select dom_id from domaines where region_id = ".$_POST['filtre_region'].")) ";
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
                                      <p><a class="tooltipped btn-floating btn-flat waves-effect waves-light btn-small" data-position="bottom" data-delay="50" data-tooltip="Description" href="#"><i style="color:#ef9a9a" class="activator material-icons">subject</i></a>
                                      <a class="btn-floating btn-flat waves-effect waves-light btn-small tooltipped" data-position="bottom" data-delay="50" data-tooltip="Modifier" href="#modal<?php echo $donnee['vin_id']; ?>"><i style="color:#ef9a9a" class="material-icons">mode_edit</i></a>
                                          <form method="POST" action="pdf.php" target="_blank">
                                          <input type="hidden" name="nom_vin" value="<?php echo $donnee['vin_nom']; ?>"/>
                                          <input type="hidden" name="description_vin" value="<?php echo $donnee['vin_description']; ?>"/>
                                          <input type="hidden" name="annee_vin" value="<?php echo $donnee['vin_annee']; ?>"/>
                                          <input type="hidden" name="couleur_vin" value="<?php echo $donnee['vin_couleur']; ?>"/>
                                          <input type="hidden" name="region_vin" value="<?php echo $donnee['region_name']; ?>"/>
                                          <input type="hidden" name="domaine_vin" value="<?php echo $donnee['dom_name']; ?>"/>
                                          <button target="_blank" type="submit" class="tooltipped btn-floating btn-flat waves-effect waves-light btn-small" target="_blank" action="pdf.php"data-position="bottom" data-tooltip="Imprimer"><i style="color:#ef9a9a" class="material-icons">print</i></form></button>
                                      <a class="btn-floating btn-flat waves-effect waves-light btn-small" href="#" onclick="$('#card_vin<?php echo $donnee['vin_id']; ?>').addClass('hide'); $('tr').show('slow'); $('thead').show('slow');"><i style="color:#ef9a9a" class="material-icons bottom">close</i></a></p>
                                  </div>
                                  <div class="card-reveal">
                                    <span class="card-title grey-text text-darken-4"><?php echo $donnee['vin_nom']; ?><i class="material-icons right">close</i></span>
                                    <p><?php echo $donnee['vin_description']; ?></p>
                                  </div>
                                </div>
                              
                              <div id="modal<?php echo $donnee['vin_id']; ?>" class="modal">
                                <div class="center-align modal-content">
                                  <h4>Modification de la fiche de vin</h4>
                                   <div class="row">
                                    <form id="form_modif" method="POST" action="post_modif.php" class="col s12 center-align">
                                        
                                             <div class="row">
                                        <div class="input-field col s12">
                                          <input placeholder="Nom du vin" name="nom_du_vin" type="text" class="validate" value="<?php echo $donnee['vin_nom']; ?>">
                                          <label for="nom_du_vin">Nom du vin</label>
                                          <input type="hidden" name="vin_id" value="<?php echo $donnee['vin_id']; ?>"/>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="input-field col s12">
                                          <input name="annee" type="text" class="validate" value="<?php echo $donnee['vin_annee']; ?>">
                                          <label for="annee">Année</label>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="input-field col s12">
                                          <select name="couleur_du_vin">
                                            <option value="Rouge">Rouge</option>
                                            <option value="Rose">Rosé</option>
                                            <option value="Blanc">Blanc</option>
                                          </select>
                                          <label for="couleur_du_vin">Couleur du vin</label>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="input-field col s10">
                                          <select name="filtre_domaine">
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
                                          <label for="domaine_du_vin">Domaine</label>
                                        </div>
                                        <div class="input-field inline col s2">
                                          <a class="left btn-floating btn-flat waves-effect waves-light btn-small" href="ajout_domaine.php"><i style="color:#ef9a9a" class="material-icons">add</i></a>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="input-field col s12">
                                          <textarea name="description_du_vin" class="materialize-textarea" value="<?php echo $donnee['vin_description']; ?>"><?php echo $donnee['vin_description']; ?></textarea>
                                          <label for="description_du_vin">Description</label>
                                      </div>
                                    
                                  </div>
                                        
                                </div>
                                <div class="modal-footer">
                                  <button form="form_modif" type="submit" action="post_modif.php" class="modal-action modal-close waves-effect waves-green btn-flat" >Valider</button>
                                  </form>
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
        </main>
  
  <br><?php include("footer.php"); ?>
  
  <script type="text/javascript">
  $(document).ready(function(){
  
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    $('.tooltipped').tooltip({delay: 80});
  });
  </script>
       </body>

</html>
