<?php
// Sous WAMP (Windows)
try
	{
        $login = 'root';
		$pass = 'misigd';
		$host = "127.0.0.1";
		$dbname = 'MonSiteDeVin';
		$charset = 'utf8';
		
		
		$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset='.$charset.'', $login, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
       
	}
catch(Exception $e)
	{
		die('Erreur de connexion: '.$e->getMessage());
	}

 function quoting($bdd, $string){
           $v=$bdd->htmlspecialchars($string);
     return $v;
        }
?>
