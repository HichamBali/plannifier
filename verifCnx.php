<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 17/04/2018
 * Time: 23:06
 */
$username = $_POST['username'];
$password = $_POST['password'];

try {
    //connexion à la base de donnée
    $connexionDB = new PDO("mysql:host=localhost;dbname=plan&go", "root", "");
    $connexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch
(PDOException $e) {
    die("Erreur: " . $e->getMessage());
}
// Hachage du mot de passe
//$pass_hache = sha1($_POST['password']);

// Vérification des identifiants
$req = $connexionDB->prepare('SELECT typeUser FROM users WHERE username = ? AND password = ?');
$req->execute(array($username,$password));

$resultat = $req->fetch();

if (!$resultat) {
    echo 'Mauvais identifiant ou mot de passe !';
} else {
    session_start();
    $_SESSION['username']=$username;
    if($resultat['typeUser'] == "secretaires"){
        header("location:homeAdmin.php");}

    elseif ($resultat['typeUser'] == "etudiant")
    {
        header("location:homeEtudiant.php");}
    elseif ($resultat['typeUser'] == "enseignant")
    {
        header("location:homeEnseignat.php");}
    elseif ($resultat['typeUser'] == "comite")
    {
        header("location:homeComite.php");}

}
?>
