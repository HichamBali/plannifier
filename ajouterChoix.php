<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 30/04/2018
 * Time: 18:38
 */



// ajouter à la bdd

session_start();
$idE = $_SESSION['idE'];

try {
    $bdd = new PDO('mysql:host=localhost;dbname=plan;charset=utf8', 'root', '');


} catch (Exception $e) {
    echo "erreur";
}


$r = $bdd->prepare('SELECT * FROM etudiants WHERE idUser = ?');
$r->execute(array($idE));
$donne=$r->fetch();
$idEtu  = $donne["idEtudiant"];



$r = $bdd->prepare('SELECT * FROM binomes WHERE idEtudiant1 = ? OR idEtudiant2 = ?');
$r->execute(array($donne["idEtudiant"], $donne["idEtudiant"]));
$donne1=$r->fetch();
$idBin  = $donne1["idBinome"];

/*

$insert = $bdd->query("INSERT INTO fichevoeuxs (idEtudiant) VALUE ($idEtudiant)");
$idFicheVoeux = $bdd->lastInsertId();
*/
$list = $_POST['lists'];
$recu= array();

$lists = parse_str($list,$recu);
$a=implode(',',$recu['item']);
$valore=explode(",","$a");



for($i=1 ; $i<=4;$i++){
    $p=$i-1;
    $k=intval("$valore[$p]");

    $r = $bdd->prepare("INSERT INTO choixbinome(idBinome,IdTheme,positions) VALUES ($idBin,$k,$i)");
    if(!$r->execute())echo json_encode("error");

}
echo json_encode("success");


?>