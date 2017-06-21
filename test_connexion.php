<?php
session_start();

if (!isset($_SESSION['id']) AND !isset($_SESSION['dn'])) {
	header ('Location: index.php');
exit();}
?>
