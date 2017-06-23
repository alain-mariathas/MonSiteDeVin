<?php
include 'test_connexion.php';
include 'post_bdd_conn.php';


if(isset($_POST['name']) and isset($_POST['adresse']) and isset($_POST['region']))
{




//Preparation de la requete
$req=$bdd->prepare('INSERT INTO domaines (dom_name, dom_adresse, region_id) VALUES(?,?,?)');	

//Execution de la requete
$req->execute(array($_POST['name'], $_POST['adresse'], $_POST['region']));


//redirection
header('location:AjoutVin.php');
}

else
{
	echo 'Veuillez renseigner tous les champs correctement';
  echo '<br><br>>> <a href="index.php">retour à la page précèdente</a> <<';
}
?>

