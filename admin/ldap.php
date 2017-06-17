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
    echo "<br>";
    $search=ldap_search($ds,"dc=sitevin","(cn=*)") or die ("Erreur dans la recherche");
    $data=ldap_get_entries($ds,$search);
    
    //affiche toutes les données
//    echo "<h1>Les utilisateurs</h1><pre>";
//    print_r($data);
//    echo "</pre>";

       //Nombre d'entrées
    echo "<h5>nombre d'entrees</h5><br>";
    echo ldap_count_entries($ds,$search);
    
    //affichage des données
    echo "<h5>affiche toutes les données</h5>";
    for($i=0; $i<$data["count"];$i++) {
      echo "user: ".$data[$i]["cn"][0]."<br/>";
        if(isset($data[$i]["mail"][0]))
        {
          echo "mail: ".$data[$i]["mail"][0]."<br/>";
        }
        else
        {
          echo "mail: None<br/><br/>";
        }
    }
    
    //ajout d'un user
#    $ldaprec["cn"]=$_POST['prenom'].".".$_POST['nom'];
#    $ldaprec["mail"]=$_POST['mail'];
#    $ldaprec["objectclass"]="inetOrgPerson";
#    $ldaprec["objectclass"]="top";
#    
#    $ajout=ldap_add($ds,"cn=".$_POST['prenom']." ".$_POST['nom'].",".$dn,$ldaprec);
#      if($ajout)
#      {
#        header("location:admin.php");
#      }
#      else
#      {
#        echo "erreur d'ajout";
#      }

  }
else
{
    echo "<br>authentification ratee";
}

//fermeture de la connexion LDAP
ldap_close($ds);

?>
