<html>
<?php include("head.php"); ?>

    <body>
    <?php include("header.php"); ?>      
      <div class="container search">
      <div id="bloc_search">
         <h3>Recherche</h3>
    <form>
    <div class="divider"></div>
    
      <div class="row">
        <div class="input-field col s6">
          <input id="SearchName" type="text">
          <label for="SearchName">Nom</label>
        </div>
      </div>
      
      <div class="row">
          <p class="range-field">
            <label for="Annee">Annee</label>
            <input type="range" id="Annee"/>
          </p>
      </div>

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

      <div class="row">
        <div class="input-field col s6">
          <input id="SearchCity" type="text">
          <label for="SearchCity">Region</label>
        </div>
      </div>
      
      <div class="row">
          <div class="input-field col s4 offset-s5">
          <input style="text-align:center"  type="submit" class="red lighten-1 pulse btn" value="valider">
      </div>
      
    </div>
    </form>
       </div> 
      </div>
      
      <div class="container main">
      <div id="bloc_mainVine">
         <h3>Vin</h3>
      <form>
          <div class="divider"></div>
    
      
          </div>
      </form>
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
