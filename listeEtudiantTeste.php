<?php
$connexionDB = new PDO("mysql:host=localhost;dbname=plan&go", "root", "");
$connexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$liste = $connexionDB->prepare('SELECT * FROM etudiants');
$liste->execute();

?>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div id="updateModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Informations patient</h2>
            </div>
            <div class="modal-body">

                <br/>
                <form method="post" id="insert_form" action="modifMoyenn.php">
                    <h4 align="center"><b><u>Informations générales :</u></b></h4>
                    <label>Nom</label>
                    <input type="text" name="nomEtu" id="nom" class="form-control" />
                    <br/>

                    <label>Prénom</label>
                    <input type="text" name="prenomEtu" id="prenom" class="form-control" />
                    <br/>

                    <label>Adresse</label>
                    <input type="text" name="adresseEtu" id="adresse" class="form-control"/>
                    <br/>

                    <label>Annee</label>
                    <textarea name="anneeEtu" id="annee" class="form-control"></textarea>
                    <br/>

                    <label>Specialite</label>
                    <input type="text" name="specialiteEtu" id="specialite" class="form-control" />
                    <br/>


                    <label>Moyenne</label>
                    <input type="number" step="0.01" name="moyenneEtu" id="moyenne" class="form-control"/>
                    <br/>


                    <input type="hidden" name="id" id="id" />
                    <input type="submit" name="update" id="update" value="modifier" class="btn btn-primary"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>

            </div>
        </div>
    </div>
</div>

<?php
include "homeSecretaire.php";
?>
<div align="center">
    <h2>Liste Etudiants</h2>
</div>
<div class="container col-md-10">
    <table id="tableEtudiant" class="table table-bordered">
    <thead>
    <tr>
        <th id="idEtudiant" role="gridcell" style="display:none">ID</th>
        <th id="nomEtu" role="gridcell">Nom</th>
        <th id="prenomEtu" role="gridcell">prenom</th>
        <th id="adresseEtu" role="gridcell">Adresse</th>
        <th id="anneeEtu" role="gridcell">annee</th>
        <th id="specialiteEtu" role="gridcell">spec</th>
        <th id="moyenneEtu" role="gridcell">moyenneEtu</th>

    </tr>
    </thead>
    <tfoot></tfoot>
        <tbody>
<?php
while($row =  $liste->fetch())
{?>

      <tr>
      <td style="display:none"><?php echo $row["idEtudiant"];?></td>
       <td><?php echo $row["nomEtu"]?></td>
       <td><?php echo $row["prenomEtu"]?></td>
       <td><?php echo $row["adresseEtu"]?></td>
       <td><?php echo $row["anneeEtu"]?></td>
       <td><?php echo $row["specialiteEtu"]?></td>
       <td><?php echo $row["moyenneEtu"]?></td>
       
        <td>                 

                            <input type="button" name="edit" value="Modifier" id="<?php echo $row["idEtudiant"]?>"
                                       class="btn btn-warning btn-md edit_data btn-block"/>
                                       </td></tr><?php
            }
            ?>
        <tbody>
    </table>

</div>
</body>



<script>

   $(document).on('click', '.edit_data', function () {

        var id = $(this).attr("id");
        $.ajax({
            url: "modifEtudiant.php",
            method: "POST",
            data: {id: id},
            dataType: "json",
            success: function (data) {
                //remplir les cases avec les anciens données
                $('#nom').val(data.nomEtu);
                $('#prenom').val(data.prenomEtu);
                $('#adresse').val(data.adresseEtu);
                $('#annee').val(data.anneeEtu);
                $('#specialite').val(data.specialiteEtu);
                $('#moyenne').val(data.moyenneEtu);

                $('#id').val(data.idEtudiant);

                $('#update').val("Modifier");
                $('#updateModal').modal('show');


            }

        });
    });



</script>
</html>


