<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 19/05/2018
 * Time: 12:20
 */


session_start();
$idE = $_SESSION['idE']; //iduser de l'etu

try {
    $bdd = new PDO('mysql:host=localhost;dbname=plan;charset=utf8', 'root', '');


} catch (Exception $e) {
    echo "erreur";
}

$r = $bdd->prepare('SELECT * FROM etudiants WHERE idUser = ?');
$r->execute(array($idE));
$donne=$r->fetch();

$etu1  = $donne["idEtudiant"];

$etu2 = $_POST['choixEtu'];

$req = $bdd->prepare('INSERT INTO binomes (idEtudiant1,idEtudiant2) VALUES(?,?)');
$req->execute(array($etu1, $etu2));
