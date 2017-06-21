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

<div id="list">
<h4 class="center">Liste des utilisateurs</h4>
                    <table class="centered highlight">
                        <thead>
                          <tr>
                              <th>CN</th>
                              <th>SN</th>
                              <th>Ville</th>
                              <th><i class="material-icons">mode_edit</i></th>
                              <th><i class="material-icons">delete</i></th>
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
    
        for($i=1; $i<$data["count"];$i++) {
      ?>
      <tr>
      <td><?php echo $data[$i]["cn"][0];?></td>
      <td><?php echo $data[$i]["sn"][0];?></td>
      <td><?php echo $data[$i]["l"][0];?></td>
        <td><a class="btn-flat waves-effect waves-light pulse" href="#modif_user<?php echo $data[$i]['sn'][0];?>"><i style="color:#ef9a9a" class="material-icons">mode_edit</i></a></td>
        <td><form method="post" action="delete_user.php"><input name="dn_to_del" type="hidden" value="<?php echo $data[$i]['cn'][0];?>"><button class="btn-flat waves-effect waves-light pulse" type="submit" onclick="confirm('êtes-vous sûr de vouloir supprimer cet utilisateur?')"><i style="color:#ef9a9a" class="material-icons">delete</i></button></td>
        </tr>
        
        <div id="modif_user<?php echo $data[$i]['sn'][0];?>" class="modal">
    <div class="center-align modal-content">
    <h4>Modification de l'utilisateur</h4>
    <div class="row">
        <form method="POST" action="add_user.php" class="col s12 center-align">
            <div class="row">
                <div class="input-field col s12">
                <input disabled name="nom_user" type="text" class="validate" value="<?php echo strstr($data[$i]['sn'][0],' '); ?>">
                <label for="nom_user">Nom de l'utilisateur</label>
                </div>
            </div>
        <div class="row">
        <div class="input-field col s12">
        <input disabled placeholder="prénom" name="prenom_user" type="text" class="validate" value="<?php echo strstr($data[$i]['sn'][0],' ',true); ?>">
        <label for="prenom_user">Prénom de l'utilisateur</label>
        </div>
        </div>
        <div class="row">
        <div class="input-field col s12">
          <input placeholder="Localité" name="ville" type="text" class="validate" value="<?php echo $data[$i]['l'][0];?>">
          <label for="ville">Ville</label>
        </div>
        </div>
        <div class="row">
        <div class="input-field col s12 inline">
        <a class="red lighten-5 btn-flat waves-effect waves-light pulse" name="password" onclick="$('#passwd').removeClass('hide'); $(this).hide();">Modifier le password</a>
        </div>
        </div>
        <div id="passwd" class="hide row">
        <div class="input-field col s12 inline">
          <input placeholder="password" name="password" type="password" class="validate" pattern="^([a-zA-Z0-9\!-\.]*){9}$" title="9 caractères dont chiffre et symbole spécial">
          <label for="password">Password</label>
                  </div>
        </div>
        </div>
        </div>
        <div class="modal-footer">
        <button action="add_user.php" class="modal-action modal-close waves-effect waves-green btn-flat" value="Valider" onclick="confirm('êtes-vous sûr de vouloir modifier cet utilisateur?')">Valider</button>
        </form>
    </div>
</div>
        
        <?php
        }
    }
    ?>
    </tbody>
</table>

<div style="margin:0 auto; width:10px;"><a class="red lighten-5 waves-effect waves-red btn-flat" href="#ajout_user"><i class="material-icons">add</i></a></div>
  
  
  <div id="ajout_user" class="modal">
                                <div class="center-align modal-content">
                                  <h4>Ajout d'un utilisateur</h4>
                                   <div class="row">
                                    <form method="POST" action="add_user.php" class="col s12 center-align">
                                      <div class="row">
                                        <div class="input-field col s12">
                                          <input placeholder="Nom de l'utilisateur" name="nom_user" type="text" class="validate">
                                          <label for="nom_user">Nom de l'utilisateur</label>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="input-field col s12">
                                          <input placeholder="prénom" name="prenom_user" type="text" class="validate">
                                          <label for="prenom_user">Prénom de l'utilisateur</label>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="input-field col s12">
                                          <input placeholder="Localité" name="ville" type="text" class="validate">
                                          <label for="ville">Ville</label>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="input-field col s12">
                                          <input placeholder="password" name="password" type="password" class="validate" pattern="^([a-zA-Z0-9\!-\.]*){9}$" title="9 caractères dont chiffre et symbole spécial">
                                          <label for="password">Password</label>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button action="add_user.php" class="modal-action modal-close waves-effect waves-green btn-flat" value="Valider" onclick="confirm('Voulez-vous valider l'ajout de cet utilisateur?')">Valider</button>
                                  </form>
                                </div>
                              </div>
  
  
  
  
</div>

</main>
<?php include('../footer.php'); ?>

<script type="text/javascript">
  $(document).ready(function(){
  
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    $('.tooltipped').tooltip({delay: 80});
  });
  </script>
</body>
	
</html>


	
