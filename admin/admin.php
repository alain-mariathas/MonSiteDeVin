<?php
include_once('../test_connexion.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

<?php include('../head.php'); ?>

    <body>
  <?php include('../header_index.php'); ?>
	<div class="main">
        
        <h2 class="center">Page d'administration</h2>

<div class="fixed-action-btn">
<button class="btn-floating btn-flat waves-effect waves-light pulse" onclick="window.history.back()"><i style="color:#ef9a9a" class="material-icons">store</i></button>
</div>

<!-- FORMULAIRE GESTION UTILISATEUR -->	

<div class="row">
    <form class="col s12" action="ldap.php" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input name="prenom" placeholder="Placeholder" id="first_name" type="text" class="validate">
          <label for="first_name">Prénom</label>
        </div>
        <div class="input-field col s6">
          <input name="nom" id="last_name" type="text" class="validate">
          <label for="last_name">Nom</label>
        </div>
      </div>
      <div class="input-field inline">
            <input name="email" id="email" type="email" class="validate">
            <label for="email" data-error="wrong" data-success="right">Email</label>
          </div>
      <div class="row">
        <div class="input-field col s12">
          <button type="submit" class="waves-effect waves-light btn"><i class="material-icons">add</i></button>
        </div>
      </div>
    </form>
</div>




</div>
<?php include('../footer.php'); ?>

</body>
	
</html>


	
