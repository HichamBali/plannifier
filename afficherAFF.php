<?php
try {
    //connexion à la base de donnée
    $connexionDB = new PDO("mysql:host=localhost;dbname=plan&go", "root", "");
    $connexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch
(PDOException $e) {
    die("Erreur: " . $e->getMessage());
}




?>
<div>

<?php include 'homeSecretaire.php'
?>
</div>
<!--<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

<!--JS -->
<div>
    <a href="TraitementAffectation.php">Affecter sujets</a>
</div>
<br/>
<meta charset="utf-8">
<div>
<table id="etudiantTable" class="table-bordered"  align="center" style="font-size:2em;width: 80%" >
    <thead>
    <th size="35px">
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
    <th>
        Enseignant encadreur
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

        $them = $connexionDB->prepare('SELECT libelle FROM  themes WHERE idTheme=?');
        $them->execute(array($donne['IdTheme']));
        $them=$them->fetch();


        $req3 = $connexionDB->prepare('SELECT * FROM  etudiants WHERE idEtudiant=?');
        $req3->execute(array($resultat['idEtudiant1']));
        $req4 = $connexionDB->prepare('SELECT * FROM  etudiants WHERE idEtudiant=?');
        $req4->execute(array($resultat['idEtudiant2']));
        $resultat1=$req3->fetch();
        $resultat2=$req4->fetch();


        ?>

        <tr>
            <td><?php echo $donne['idBinome']; ?></td>
            <td><?php echo $resultat1['nomEtu']."    ".$resultat1['prenomEtu']; ?></td>
            <td><?php echo $resultat2['nomEtu']."    ".$resultat2['prenomEtu']; ?></td>
            <td><?php echo $donne['IdTheme']; ?></td>
            <td><?php echo $them['libelle']; ?></td>
        </tr>


        <?php
    }
}






}

?>

</tbody></table></div>


</div>







