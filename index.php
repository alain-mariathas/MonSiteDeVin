<html>
<?php include("head.php"); ?>
    <body>
    <?php include("header.php");
    include("test_connexion_bdd.php")
     ?>
      <div class="container main">
      <div id="bloc_connexion">
         <h3>Connexion</h3>
    <form>
    <div class="divider"></div>
      <div class="row">
        <div class="input-field col s6">
          <input id="email" type="email" class="validate">
          <label for="email" data-error="wrong" data-success="right">Email</label>
        </div>
        <div class="input-field col s6">
          <input id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
              <div class="input-field col s4 offset-s5">
          <input style="text-align:center" type="submit" class="red lighten-1 pulse btn" value="valider">
      </div> 
    </div>
    </form>
       </div> 
      </div>
  <?php include("footer.php"); ?>
    </body>

</html>
