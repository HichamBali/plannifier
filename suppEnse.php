<?php

$ids=$_POST['ids'];



try {

    $connexionDB = new PDO('mysql:host=localhost;dbname=plan&go', 'root', '');

    $query = $connexionDB->prepare("DELETE FROM enseigants WHERE idEnseignant=$ids ");
    if($query->execute())
    {
        echo "success";
    }
    else echo "eroor";
    //le id Medecin!


} catch
(PDOException $e) {
    die("Erreur: " . $e->getMessage());
}



?>