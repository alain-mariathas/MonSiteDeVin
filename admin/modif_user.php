<?php 
include("test_connexion.php");

echo "Connexion au serveur LDAP....";

$server="localhost";
$port="389";
$dn="dc=sitevin";
$rootdn="cn=admin,$dn";
$rootpw="misigd";

$ds=ldap_connect($server,$port)//;
//ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        or die ("Impossible de se connecter au serveur ! \n");
echo "<br>Connexion sur le serveur OpenLDAP -> OK \n\n";

ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);


$bind=ldap_bind($ds,$rootdn,$rootpw);
if($bind)
  {
    echo "<br>authentification reussie";
    
    //ajout d'un user
    $ldaprec["l"]=$_POST["ville"];
    if(isset($_POST["password"]))
    {
      $ldaprec["userPassword"][0]=$_POST["password"];
    }

    print_r($ldaprec);
    

//fermeture de la connexion LDAP
ldap_close($ds);

?>
