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
    $ldaprec["objectclass"][0]="organizationalPerson";
    $ldaprec["objectclass"][1]="Person";
    $ldaprec["objectclass"][2]="top";
    $ldaprec["cn"]=(substr($_POST['prenom_user'],0,1).".".$_POST['nom_user']);
    $ldaprec["sn"]=($_POST['prenom_user'].' '.$_POST['nom_user']);
    $ldaprec["l"]=$_POST["ville"];
    $ldaprec["userPassword"]=$_POST["password"];

    print_r($ldaprec);
    
    $ajout=ldap_add($ds,("cn=".$ldaprec["cn"].",".$dn),$ldaprec);
    
    echo $ajout;
      if($ajout)
      {
        header("location:admin.php");
      }
      else
      {
        echo "erreur d'ajout";
      }

  }
else
{
    echo "<br>authentification ratee";
}

//fermeture de la connexion LDAP
ldap_close($ds);

?>
