<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 17/04/2018
 * Time: 23:07
 */


$nomEtu = $_POST['nomEtu'];
$prenomEtu = $_POST['prenomEtu'];
$adresseEtu = $_POST['adresseEtu'];

$anneeEtu = $_POST['anneeEtu'];
$specialiteEtu = $_POST['specialiteEtu'];

$username = $_POST['username'];
$password = $_POST['password'];
$etudiant  = 'etudiant';

try {

    $connexionDB = new PDO('mysql:host=localhost;dbname=plan', 'root', '');
    $connexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $insert = "INSERT INTO users(username, password, typeUser)
      VALUES ('" . $username . "','" . $password . "', '". $etudiant ."')";
    $connexionDB->exec($insert);
    $idUser = $connexionDB->lastInsertId();

    $insert = "INSERT INTO etudiants(nomEtu, prenomEtu, adresseEtu, anneeEtu, specialiteEtu, idUser)
      VALUES ('" . $nomEtu . "','" . $prenomEtu . "','" . $adresseEtu . "','" . $anneeEtu . "','" . $specialiteEtu . "','" . $idUser . "')";
    $connexionDB->exec($insert);


    header("location:homeEtudiant.php");
} catch
(PDOException $e) {
    die("Erreur: " . $e->getMessage());
}