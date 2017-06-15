
<?php
include_once('../test_connexion.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

<?php include('../head.php'); ?>

    <body>

        
	<div class="main">
        
        <h4>
			ADMINISTRATION LDAP         
		</h4>

<!-- FORMULAIRE GESTION UTILISATEUR -->	
        
        <?php

// LDAP variables
$ldaphost = "";  // votre serveur LDAP
$ldapport = 389;                 // votre port de serveur LDAP
// Eléments d'authentification LDAP
$ldaprdn  = '';     // DN ou RDN LDAP
$ldappass = '';  // Mot de passe associé
        
// Connexion LDAP
try{
    $ldapconn = ldap_connect($ldaphost, $ldapport);
    }
        catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
        
        if ($ldapconn) {

    // Connexion au serveur LDAP
            ?>
        Connection réussie<br>
        <?php
    $ldapbind = ldap_bind($ldapconn);
            
            if($ldapbind)
            {
                ?>
        tesssst 2
        <?php
            }
            
            $dn = "";
        $value = "";
        $attr = "";

        // Comparaison des valeurs
        $r=ldap_compare($ldapconn, $dn, $attr, $value);
            
            if($r == true){
                ?>
        <br> succes
        <?php
            }
            
            
            $filter="";

            echo $dn;
$sr=ldap_search($ldapconn, $dn, $filter);

$info = ldap_get_entries($ldapconn, $sr);

            echo $info;


        }

?>
        
<?php include('../footer.php'); ?>

        </div>
</body>
	
</html>


	
