<?php
include_once 'test_connexion.php';
include_once 'post_bdd_conn.php';

if(isset($_GET['vin_id']))
{

 $supp = $bdd->prepare('DELETE FROM vins WHERE vin_id='.$_GET['vin_id'].';');
    $supp->execute();

header('location:vinebody.php');
}
else
{
	echo 'Erreur';
}
?>
