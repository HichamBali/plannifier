<?php

$nom = $_POST['nom_e'];
$prenom = $_POST['prenom_e'];
$adresse = $_POST['adresse_e'];
$grade = $_POST['grade_e'];
$username = $_POST['user'];
$password = $_POST['password'];
$type = "enseignant";
$insert = $_POST['insert'];
// ajouter medecin
if ($insert == 'Valider') {

    try {

        $connexionDB = new PDO('mysql:host=localhost;dbname=plan&go', 'root', '');

        $insert1 = $connexionDB->prepare("INSERT INTO users(username, password, typeUser)
      VALUES (?,?,?)");
        $insert1->execute(array($username,$password,$type));

        $idU=$connexionDB->lastInsertId();
        $insert2 = $connexionDB->query("INSERT INTO enseigants(nomEns, prenomEns, adresseEns, gradeEns,idUser)
      VALUES ('" . $nom . "','" . $prenom . "','" . $adresse . "','" . $grade . "','" . $idU . "')");

        header("location:listeEnseignants.php");
    } catch
    (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
}
else {
    try {
        $connexionDB = new PDO('mysql:host=localhost;dbname=service', 'root', '');

        $id = $_POST['id'];


        $query = "UPDATE enseigants SET nomEns=?, prenomEns=?, adresseEns=? , gradeEns=?, WHERE idEnseignant=?";

        $query = $connexionDB->prepare($query);

        $query->execute(array($nom, $prenom,$adresse, $grade,$id));

        header("location:listeEnseignants.php");
    } catch
    (PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
}