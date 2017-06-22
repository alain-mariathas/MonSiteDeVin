<?php
session_start();

if (!isset($_SESSION['id']) AND !isset($_SESSION['cn'])) {
	header ('Location: index.php');
exit();}
?>
