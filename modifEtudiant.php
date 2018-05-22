<?php
//Affichage de la page modifierPatient
//remplir les cases avec les anciens données

if(isset($_POST["id"]))
{
    $output = '';
    $connect = mysqli_connect("localhost", "root", "", "plan&go");
    $query = "SELECT * FROM etudiants WHERE idEtudiant = '" . $_POST["id"] . "'";
    $result = mysqli_query($connect, $query);
    echo json_encode(mysqli_fetch_array($result));


}