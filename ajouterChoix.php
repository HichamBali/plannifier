<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 30/04/2018
 * Time: 18:38
 */



// ajouter à la bdd

try {
    $bdd = new PDO('mysql:host=localhost;dbname=plan;charset=utf8', 'root', '');


} catch (Exception $e) {
    echo "erreur";
}


$list = $_POST['lists'];
$recu= array();

$lists = parse_str($list,$recu);
$a=implode(',',$recu['item']);
$valore=explode(",","$a");

for($i=1 ; $i<=4;$i++){
    $p=$i-1;
    $k=intval("$valore[$p]");

    $r = $bdd->prepare("INSERT INTO voeuxs(idFicheVoeux,idTheme,position) VALUES (1,$k,$i)");
    if(!$r->execute())echo json_encode("error");

}
echo json_encode("success");


?>