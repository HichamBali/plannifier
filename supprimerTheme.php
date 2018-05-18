<?php
/**
 * Created by PhpStorm.
 * User: Hichem
 * Date: 19/04/2018
 * Time: 21:06
 */

$id=$_POST['id'];



try {

    $connexionDB = new PDO('mysql:host=localhost;dbname=plan&go', 'root', '');

    $query = $connexionDB->prepare("DELETE FROM themes WHERE idTheme=$id ");
    if($query->execute())
    {
        echo "success";
    }
    else echo "eroor";
    //le id Patient!


} catch
(PDOException $e) {
    die("Erreur: " . $e->getMessage());
}