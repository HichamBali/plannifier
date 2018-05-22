<?php
$connexionDB = new PDO('mysql:host=localhost;dbname=plan&go', 'root', '');

$idEtudiant = $_POST['id'];


$query = "UPDATE etudiants SET moyenneEtu=? WHERE idEtudiant=?";

$query = $connexionDB->prepare($query);

$query->execute(array($_POST['moyenneEtu'],$idEtudiant));

header("location:listeEtudiantTeste.php");
?>