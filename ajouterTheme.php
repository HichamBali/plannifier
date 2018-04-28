<?php
/**
 * Created by PhpStorm.
 * User: Hichem
 * Date: 19/04/2018
 * Time: 16:49
 */

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
if ($proposerTheme == 'Proposer') {
    $req = $connexionDB->prepare('INSERT INTO themes (libelle,description,nombreBinome,idEnseignant) VALUES(?,?,?,1)');
    $req->execute(array($libelle, $description, $nombreBinome));}
else{
    $idTheme = $_POST['id'];
    $theme = $connexionDB->prepare('UPDATE themes SET libelle=?, description=?, nombreBinome=? WHERE idTheme=?');
    $theme = $theme->execute(array($libelle, $description, $nombreBinome,$idTheme));
}
header("location:themes.php");
?>
