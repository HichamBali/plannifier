<?php
try {
    //connexion à la base de donnée
    $connexionDB = new PDO("mysql:host=localhost;dbname=plan&go", "root", "AHENr5Jfovmf");
    $connexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch
(PDOException $e) {
    die("Erreur: " . $e->getMessage());
}




?>
<!DOCTYPE html>


<html>
<body>

<center><!-- <input type="button" value="Affecter" id="aff"/> --> <a href="TraitementAffectation.php">Affecter</a> </center>



<table>
    <thead>
    <th>
        idBinome
    </th>
    <th>
        Etudiant_1
    </th>
    <th>
        Etudiant_2
    </th>
    <th>
        Theme

    </th>
    </thead>
<tbody>
<?php
$req = $connexionDB->prepare('SELECT * FROM  BinomeTheme');
if($req->execute()){
while ($donne = $req->fetch()) {

    $req2 = $connexionDB->prepare('SELECT * FROM  binomes WHERE idBinome=?');
    if($req2->execute(array($donne['idBinome']))) {
        $resultat=$req2->fetch();



        $req3 = $connexionDB->prepare('SELECT * FROM  etudiants WHERE idEtudiant=?');
        $req3->execute(array($resultat['idEtudiant1']));
        $req4 = $connexionDB->prepare('SELECT * FROM  etudiants WHERE idEtudiant=?');
        $req4->execute(array($resultat['idEtudiant2']));
        $resultat1=$req3->fetch();
        $resultat2=$req4->fetch();


        ?>

        <tr>
            <td><?php echo $donne['idBinome']; ?></td>
            <td><?php echo $resultat1['nomEtu']." _ ".$resultat1['prenomEtu']; ?></td>
            <td><?php echo $resultat2['nomEtu']." _ ".$resultat2['prenomEtu']; ?></td>
            <td><?php echo $donne['IdTheme']; ?></td>
        </tr>


        <?php
    }
}






}

?>

</tbody></table>

</body>
</html>



