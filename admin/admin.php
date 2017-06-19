<?php
include_once('../test_connexion.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

<?php include('../head.php'); ?>

    <body>
      <?php include('../header_index.php'); ?>
    <main style="min-height:300px">

	<div class="main">
        
        <h2 class="center">Page d'administration</h2>

<div class="fixed-action-btn">
<a class="btn-floating btn-flat waves-effect waves-light pulse" href="../vinebody.php" onclick=""><i style="color:#ef9a9a" class="material-icons">store</i></a>
</div>

<!-- FORMULAIRE GESTION UTILISATEUR -->	
<h4 class="center">Liste des utilisateurs</h4>


<div id="list">
                    <table class="centered highlight">
                        <thead>
                          <tr>
                              <th>CN</th>
                              <th>DN</th>
                              <th>Mail</th>
                              <th><i class="material-icons">mode_edit</i></th>
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
      <td><?php echo $data[$i]["cn"][0];?></td>
      <td><?php echo $data[$i]["dn"][0];?></td>
       <td><?php echo $data[$i]["mail"][0];?></td>
        <td><a href="#"><i class="material-icons">mode_edit</i></a></td>
        <?php
        }
    }
    ?>
    </tbody>
</table>
</div>

</div>
</main>
<?php include('../footer.php'); ?>

</body>
	
</html>


	
