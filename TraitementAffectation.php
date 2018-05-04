<?php
/**
 * Created by PhpStorm.
 * User: THE_MMN1
 * Date: 03/05/2018
 * Time: 14:02
 */





try {
    //connexion à la base de donnée
    $connexionDB = new PDO("mysql:host=localhost;dbname=plan&go", "root", "AHENr5Jfovmf");
    $connexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch
(PDOException $e) {
    die("Erreur: " . $e->getMessage());
}




$req = $connexionDB->prepare('SELECT * FROM  binomes ORDER BY MoyenneB DESC ');
if($req->execute()){
    for($i=0;($result = $req->fetch());$i++){

        $iDBinome=$result['idBinome'];
        $req1 = $connexionDB->prepare('SELECT * FROM  choixbinome WHERE idBinome=? ORDER BY positions ASC ');
        if($req1->execute(array($iDBinome))){

            for($j=0;($result1 = $req1->fetch());$j++){
                $idTheme=$result1['IdTheme'];
                $req2 = $connexionDB->prepare('SELECT count(*) AS TT FROM  themes WHERE idTheme=? AND valide=1 AND Pris=0');
                $req2->execute(array($idTheme));
                $PP=$req2->fetch();
                $rr=$PP['TT'];
                echo $rr;
                if($rr!=0){
                    $req3 = $connexionDB->prepare('UPDATE  themes set Pris=1 WHERE idTheme=?');
                    if($req3->execute(array($idTheme))){

                        $req4 = $connexionDB->prepare('INSERT INTO binometheme(idBinome,IdTheme) VALUES (?,?)');
                        $req4->execute(array($iDBinome,$idTheme));


                    }
                    break;

                }


            }




        }

        else echo "error";






}
header("location:afficherAFF.php");
}
else echo "error fertch 1";


