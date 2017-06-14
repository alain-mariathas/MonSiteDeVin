<?php
session_start();

if (!isset($_SESSION['id']) AND !isset($_SESSION['email'])) {
	header ('Location: index.php');
exit();}
?>