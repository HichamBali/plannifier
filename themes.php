<?php
$connexionDB = new PDO("mysql:host=localhost;dbname=plan&go", "root", "");
$connexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();
$Ens = $_SESSION['username'];
$idUs=$connexionDB->prepare('SELECT * FROM users WHERE username = ?');
$idUs->execute(array($Ens));
$idUs=$idUs->fetch();
$user = $connexionDB->prepare('SELECT * FROM enseigants WHERE idUSer = ?');
$user->execute(array($idUs['id']));
$user=$user->fetch();
$idEn =  $user['idEnseignant'];
$liste = $connexionDB->prepare('SELECT * FROM themes WHERE idEnseignant=?');
$liste->execute(array($idEn));

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Details</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery.min.js"></script>


</head>

<body id="page-top">
<?php
include "homeEnsei.php";
?>





<div class="my-auto" align="center">
    <h3 class="mb-5">Theme</h3></div>

    <div align="left"><button type="button" name="ajout" id="addcons" class="btn btn-primary" onclick="$('#ajoutTheme').modal('show');">
        <i class="fa fa-plus"></i>Ajouter</button>
</div>

<div id="ajoutTheme" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style=" margin-left: -15%;
    margin-top: 10%;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Proposer theme</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <br/>
                <form method="POST" id="insert_form" action="ajouterTheme.php">

                    <label>Libelle</label>
                    <textarea  name="libelle" id="libelle" class="form-control" ></textarea>
                    <br/>

                    <label>Description</label>
                    <textarea  name="description" id="description" class="form-control" ></textarea>
                    <br/>

                    <label>Nombre de binome </label>
                    <input type="number" name="nombreBinome" id="nombreBinome" class="form-control"/>
                    <br/>
                    <input type="hidden" name="id" id="id" />

                    <input type="submit" name="proposerTheme" id="proposerTheme" value="Proposer" class=" formBtn btn btn-primary"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>

            </div>
        </div>
    </div>
</div>


    <div class="container col-md-10">

        <table id="tableThemes" role="grid" class="table table-bordered">
            <thead>
            <tr>
                <th style="display:none">id</th>
                <th>Libelle</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <!--ici on recupere les donnee du tab de la bdd -->
            <?php
            while($row =  $liste->fetch())
            {
                echo '
      <tr>
      <td style="display:none">'.$row["idTheme"].'</td>
       <td>'.$row["libelle"].'</td>
       <td>'.$row["description"].'</td>
       
        <td>

                    <div class="btn-group">
                        <button type="button"
                                class="btn btn-primary btn-lm dropdown-toggle" data-toggle="dropdown">
                            Action
                        </button>
                        <ul class="dropdown-menu" role="menu">

                            <li><input type="button" name="edit" value="Modifier" id="'.$row["idTheme"].'"
                                       class="btn btn-info btn-md edit_data btn-block"/></li>

                            <li><input type="button" name="delete" value="Supprimer" id="'.$row["idTheme"].'"
                                       class="btn btn-danger btn-md delete_data btn-block"/></li>
                                       
                                
                             </ul>
                    </div>


                </td>
      
       </tr>
      ';
            }
            ?>

            <tbody>
        </table>

    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='http://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js'></script>
<script src='http://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js'></script>


<!-- Bootstrap core JavaScript -->

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/resume.min.js"></script>

<script>
    /******************************************* ajouter theme*********************************/
    $('#ajout').click(function () {
        $('#proposerTheme').val("Proposer");
            });



    /**modifier theme**/

    $(document).on('click', '.edit_data', function () {
        var id = $(this).attr("id");
        $.ajax({
            url: "modifierTheme.php",
            method: "POST",
            data: {id: id},
            dataType: "json",
            success: function (data) {
                //remplir les cases avec les anciens données
                $('#libelle').val(data.libelle);
                $('#description').val(data.description);
                $('#nombreBinome').val(data.nombreBinome);
                $('#insert_form #id').val(data.idTheme);

                $('#proposerTheme').val("Modifier");
                $('#ajoutTheme').modal('show');


            }

        });
    });


    /**Supprimer theme**/

    $(document).on('click','.delete_data', function(){

        var id=$(this).attr("id");
        if(confirm("Voulez vous supprimer ce theme?")){

            $.ajax({
                url:'supprimerTheme.php',
                type: 'POST',
                data:{
                    id:id
                },
                success: function(result){
                    if(result.trim() == "success")
                        window.location.reload();
                    else alert(result.trim());

                }
            });



        }

    });


</script>

</body>

</html>
