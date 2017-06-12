<html>
<?php include("head.php"); ?>

    <body>
    <?php include("header.php"); ?>      
              
        
         <div id="bloc_search">
        <h3>Recherche</h3>
        <div class="divider"></div>
          <form id="form_search">
               <div class="row">
                <div class="input-field">
                  <input id="SearchName" type="text">
                  <label for="SearchName">Nom</label>
                </div>
              </div>

              <div class="row">
                <label for="Annee">Annee</label>
                  <div class="input-field">
                     <p class="range-field">
                    <input type="range" id="Annee"/>
                  </p>
                  </div>
              </div>

                <div class="row">
                    <label for="region_boxes">Couleurs</label>
                    <div id="couleur_boxes" class="input-field">
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
                    <div class="input-field">
                      <input id="SearchCity" type="text">
                      <label for="SearchCity">Region</label>
                    </div>
                  </div>

            <div class="row">
              <div class="input-field center-align">
              <input style="text-align:center"  type="submit" class="red lighten-1 pulse btn" value="valider">
            </div>
            </div>
        </form>
            </div> 
        
      <div id="vinebody" class="container main">
        <h3>Vin</h3>
        <div class="divider"></div>

          <div id="bloc_mainVine">
              <div id="list">
              <button onclick="$('#card_vin').show('slow'); $('#list').hide('slow');">test</button>
              </div>
              
 <div id="card_vin" style="margin-top:10%; margin-bottom:10%" class="card large">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="img/vin_card.jpg">
    </div>
    <div class="card-content">
      <span class="card-title grey-text text-darken-4"><a class="btn-flat" style="color:black " onclick="$('#card_vin').hide('slow'); $('#list').show('slow');"><i class="material-icons left">fast_rewind</i></a>Vin Rouge qui tâche<i class="activator material-icons right">more_vert</i></span>
      <p><a href="#">Imprimer cette fiche</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Vin Rouge qui tâche<i class="material-icons right">close</i></span>
      <p>Une valeur sûre pour ce Bordeaux rouge médaillé d'Or à Paris! Un rapport qualité-prix bluffant sur un millésime 2015 qui s'inscrit déjà dans la lignée des légendaires 2009 et 2010!!!
MonSiteDeVin vous présente le GRAND gagnant de notre sélection de "petits" Bordeaux. Dégusté en Mars 2016 parmi plus de 40 vins, nous sommes unanimes: ce Château Jean de Marceau 2015 est LA valeur sûre! Fruité, élégant, avec des tanins bien fondus, il sera parfait pour accompagner vos repas entre amis en toute occasion: charcuteries et terrines, viandes mijotées et grillées, fromages... C'est le compagnon idéal qui sublimera vos convives. Un petit bijou Bordelais sur un millésime déjà mythique à prix complètement canon!</p>
        <a href="#"><i class="material-icons right">print</i></a>

    </div>
  </div>
              
              
              
        </div>


      </div>
  <?php include("footer.php"); ?>
  <script type="text/javascript">
  var slider = document.getElementById('Annee');
  noUiSlider.create(slider, {
   start: [1960,2017],
   connect: true,
   step: 1,
   range: {
     'min': 1960,
     'max': 2017
   },
   format: wNumb({
     decimals: 0
   })
  });
  </script>
    </body>

</html>
