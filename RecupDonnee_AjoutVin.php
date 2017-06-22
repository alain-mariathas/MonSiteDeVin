<?php
include_once 'test_connexion.php';
include_once 'post_bdd_conn.php';


$req=$bdd->prepare("INSERT INTO vins (vin_nom, vin_couleur, vin_annee, vin_description,domaine_id) VALUES (?,?,?,?,?);"); 

$req->execute(array($_POST["Name"],$_POST["Color"],$_POST["Year"],$_POST["DescriptionDuVin"],$_POST["DomaineName"]));

?>
