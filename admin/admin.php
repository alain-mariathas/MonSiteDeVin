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

<div id="list">
                    <table class="centered highlight">
                        <thead>
                          <tr>
                              <th>Nom</th>
                              <th>Prenom</th>
                              <th>Email</th>
                              <th> </th>
                          </tr>
                        </thead>

                        <tbody>
<?php

$server="localhost";
$port="389";
$dn="dc=sitevin";
$rootdn="cn=admin,$dn";
$rootpw="misigd";

$ds=ldap_connect($server,$port)//;
//ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        or die ("Impossible de se connecter au serveur ! \n");

ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);


$bind=ldap_bind($ds,$rootdn,$rootpw);
if($bind)
  {
  $search=ldap_search($ds,"dc=sitevin","(cn=*)") or die ("Erreur dans la recherche");
    $data=ldap_get_entries($ds,$search);
    
        for($i=0; $i<$data["count"];$i++) {
      ?>
      <th><?php $data[$i]["cn"][0];?></th>
      <th><?php $data[$i]["prenom"][0];?></th>
       <th><?php $data[$i]["mail"][0];?></th>
        
        <?php
        }
    }
    }
?>






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


	
