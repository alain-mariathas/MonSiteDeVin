<?php 
include_once "test_connexion.php";
$_SESSION = array();

session_destroy();

header('Location: index.php');

?>