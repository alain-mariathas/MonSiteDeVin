<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<?php include("head.php"); ?>
    <body>
    <?php include("header_index.php");
    //include("user_auth.php")
     ?>
      <div class="container main">
      <div id="bloc_connexion" class="center-align">
         <h3>Connexion</h3>
    <form id="form_conn" name="form_conn" action="post_connexion.php" method="post">
    <div class="divider"></div>
      <div class="row">
          <div class="input-field col s6">
          <i class="material-icons prefix">account_circle</i>
              <input name="account" id="account" type="text" class="validate"/>
          <label for="account" data-error="invalide" data-success="valide">Login</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">lock</i>
                        <label for="password">Password</label>
            <input name="password" id="password" type="password" class="validate"/>
          
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
