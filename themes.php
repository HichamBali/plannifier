<?php
session_start();

if(isset($_GET['idEns']))
{$idEns=$_GET['idEns'];
    $_SESSION['idEns']=$idEns;
}
else{
    $idEns = $_SESSION['idEns'];
}


?>


<?php
$connexionDB = new PDO("mysql:host=localhost;dbname=plan", "root", "");
$connexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$liste1 = $connexionDB->prepare('SELECT * FROM enseigants WHERE idUser=?');
$liste1->execute(array($idEns));
$donne=$liste1->fetch();
$idEnseignant = $donne['idEnseignant'];

$liste = $connexionDB->prepare('SELECT * FROM themes WHERE idEnseignant=?');
$liste->execute(array($idEnseignant));
$liste->execute();

?>

<!DOCTYPE html>
<html lang="fr">

<head>


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Carlos Alvarez - Alvarez.is">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>

        <link href="css/main.css" rel="stylesheet">

       <link rel='stylesheet prefetch' href='http://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css'>


        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="js/lineandbars.js"></script>

        <script type="text/javascript" src="js/dash-charts.js"></script>
        <script type="text/javascript" src="js/gauge.js"></script>

        <!-- NOTY JAVASCRIPT -->
        <script type="text/javascript" src="js/noty/jquery.noty.js"></script>
        <script type="text/javascript" src="js/noty/layouts/top.js"></script>
        <script type="text/javascript" src="js/noty/layouts/topLeft.js"></script>
        <script type="text/javascript" src="js/noty/layouts/topRight.js"></script>
        <script type="text/javascript" src="js/noty/layouts/topCenter.js"></script>

        <!-- You can add more layouts if you want -->
        <script type="text/javascript" src="js/noty/themes/default.js"></script>
        <!-- <script type="text/javascript" src="assets/js/dash-noty.js"></script> This is a Noty bubble when you init the theme-->
        <script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
        <script src="js/jquery.flexslider.js" type="text/javascript"></script>

        <script type="text/javascript" src="js/admin.js"></script>

        <!-- tableau sortable -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">



        <style type="text/css">
            body {
            //  background-color: #C3654B ;
            //   background-color:#6F9130 ;

                padding-top: 60px;
            }
            .navbar-nav{
            //   background-color: #C3654B ;
                background-color: #C3654B ;

            }
        </style>


    </head>

<body>
<!--------------------------------------NAVBAR------------------------------------------>
<div class="navbar-nav navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" ><img src="images/plan.png" id="plan"> </a>
        </div>

        <div class="navbar-collapse my-2 my-lg-0">
            <a href="logOut.php" class="navbar-brand pull-right" ><strong class="fa fa-power-off"> Déconnexion</strong></a>
            <a href="homeEnseignant.php" class="navbar-brand pull-right" ><strong class="fa fa-arrow-circle-o-left"> Retour</strong></a>
        </div>  <!--/.nav-collapse -->
    </div>
</div>
<!-------------------------------------------liste des thèmes---------------------------------------------------->
<div class="row justify-content-center">
<div class="col-10">
<div align="center">
    <br/>     <br/>

    <button type="button" name="ajout" id="addcons" class="btn btn-primary" onclick="$('#ajoutTheme').modal('show');">
        <i class="fa fa-plus"></i>Ajouter un thème</button>
    <br/>

</div>

<div id="ajoutTheme" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
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



<div class="resume-item d-flex flex-column flex-md-row mb-5">
    <!-- col md sm ...-->

    <div class="table-responsive">

        <table id="tableThemes" role="grid" class="table table-striped table-bordered">


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
                            Action <span class="caret"></span>
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
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='http://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js'></script>
<script src='http://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js'></script>



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

