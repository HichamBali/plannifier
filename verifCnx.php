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
$req = $connexionDB->prepare('SELECT id, typeUser FROM users WHERE username = ? AND password = ?');
$req->execute(array($username,$password));


$resultat = $req->fetch();

if (!$resultat) {
    echo 'Mauvais identifiant ou mot de passe !';
    header("location:login.html");
} else {
    session_start();
    $_SESSION['username']=$username;


    if($resultat['typeUser'] == "secretaires"){
        header("location:homeAdmin.php");
        $req = $connexionDB->prepare('SELECT idSecretaire FROM secretaires WHERE secretaires.idUser = ? ');
        $req->execute(array($resultat['id']));

        $_SESSION['idSecretaire'] = $resultat['id'];
    }

    elseif ($resultat['typeUser'] == "etudiant")
    {
        $req = $connexionDB->prepare('SELECT idEtudiant FROM etudiants  WHERE etudiants.idUser = ? ');
        $req->execute(array($resultat['id']));

        $_SESSION['idEtudiant'] = $resultat['id'];

        header("location:homeEtudiant.php");}

    elseif ($resultat['typeUser'] == "enseignant")
    {
        $req = $connexionDB->prepare('SELECT idEnseignant FROM enseigants WHERE idUser = ? ');
        $req=$req->execute(array($resultat['id']));
        $_SESSION['idEnseigant'] = $resultat['id'];
        header("location:themes.php");}
    elseif ($resultat['typeUser'] == "comite")
    {
        $req = $connexionDB->prepare('SELECT idComite FROM comites  WHERE comites.idUser = ? ');
        $req->execute(array($resultat['id']));

        $_SESSION['idComite'] = $resultat['id'];
        header("location:homeComite.php");}

}
?>