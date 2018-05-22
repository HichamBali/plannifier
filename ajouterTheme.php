<?php
/**
 * Created by PhpStorm.
 * User: Hichem
 * Date: 19/04/2018
 * Time: 16:49
 */
session_start();
$Ens = $_SESSION['username'];
try {
    //connexion à la base de donnée
    $connexionDB = new PDO("mysql:host=localhost;dbname=plan&go", "root", "");
    $connexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch
(PDOException $e) {
    die("Erreur: " . $e->getMessage());
}
$libelle = $_POST['libelle'];
$description = $_POST['description'];
$nombreBinome = $_POST['nombreBinome'];
$proposerTheme = $_POST['proposerTheme'];
$idUs=$connexionDB->prepare('SELECT * FROM users WHERE username = ?');
$idUs->execute(array($Ens));
$idUs=$idUs->fetch();
$user = $connexionDB->prepare('SELECT * FROM enseigants WHERE idUSer = ?');
    $user->execute(array($idUs['id']));
    $user=$user->fetch();
     $idEn =  $user['idEnseignant'];
if ($proposerTheme == 'Proposer') {
    $req = $connexionDB->prepare('INSERT INTO themes (libelle,description,nombreBinome,idEnseignant,valide	) VALUES(?,?,?,?,?)');
    $req->execute(array($libelle, $description,1,$idEn,0));}
else{
    $idTheme = $_POST['id'];
    $theme = $connexionDB->prepare('UPDATE themes SET libelle=?, description=?, nombreBinome=? WHERE idTheme=?');
    $theme = $theme->execute(array($libelle, $description, $nombreBinome,$idTheme));
}
header("location:themes.php");
?>
