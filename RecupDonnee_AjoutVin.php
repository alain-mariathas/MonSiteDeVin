<?php
    include("head.php");
    include("post_bdd_conn.php");
    include("test_connexion.php");
    
$req = $bdd->prepare('INSERT INTO vins(vin_nom, vin_couleur, vin_annee, vin_description, domaine_id) VALUES(?,?,?,?,?)');

$req->execute(array($_POST['name'],$_POST['color'],$_POST['year'],$_POST['descriptionduvin'],$_POST['domaine']));

header('location:vinebody.php');

?>
