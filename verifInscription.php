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

    $connexionDB = new PDO('mysql:host=localhost;dbname=plan&go', 'root', '');

    $insert = $connexionDB->query("INSERT INTO etudiants(nomEtu, prenomEtu, adresseEtu, anneeEtu, specialiteEtu)
      VALUES ('" . $nomEtu . "','" . $prenomEtu . "','" . $adresseEtu . "','" . $anneeEtu . "','" . $specialiteEtu . "')");

    $insert = $connexionDB->query("INSERT INTO users(username, password, typeUser)
      VALUES ('" . $username . "','" . $password . "', '". $etudiant ."')");

    header("location:homeEtudiant.php");
} catch
(PDOException $e) {
    die("Erreur: " . $e->getMessage());
}
