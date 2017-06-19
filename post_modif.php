<?php
include_once '../test_connexion.php';
include_once '../post_bdd_conn.php';


if(isset($_POST['nom_du_vin']) and isset($_POST['vinid']))
{
//Preparation de la requete
$req=$bdd->prepare('UPDATE vins SET vin_nom=?, vin_couleur=?, vin_annee=?, vin_description=?, domaine_id=? where vin_id='.$_POST['vinid'].';');	

//Execution de la requete
$req->execute(array($_POST['nom_du_vin'], $_POST['couleur'], $_POST['annee'], $_POST['description'], $_POST['domaine']));


//redirection
header('location:vinebody.php');
}

else
{
	echo 'Veuillez renseigner tous les champs correctement';
  echo '<br><br>>> <a href="index.php">retour à la page précèdente</a> <<';
}
?>

