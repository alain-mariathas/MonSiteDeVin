<?php

$req = $bdd->prepare('INSERT INTO domaines(dom_name, dom_adresse) VALUES(:VineDomaineNom, :VineDomaineAdresse)');

$req->execute(array(

    'dom_name' => $VineDomaineNom,

    'dom_adresse' => $VineDomaineAdresse,


    ));



?>
