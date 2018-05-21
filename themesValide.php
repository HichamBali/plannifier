<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 21/05/2018
 * Time: 05:05
 */
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
            <a href="homeEnseignant.php"class="navbar-brand pull-right" ><strong class="fa fa-arrow-circle-o-left"> Retour</strong></a>
        </div>  <!--/.nav-collapse -->
    </div>
</div>


<br/><br/>

<h2 align="center" style="color: #2b542c"><u> Liste des thèmes validés </u> </h2> <!--titre-->

<br/><br/>
<div class="row justify-content-center">
    <div class="col-10">
        <div class="table-responsive" id="table">

            <table id="tableTheme" role="grid" class="table table-striped table-bordered">

                <!-- le head du tableau-->
                <thead>
                <tr>
                    <th id="idINFIRMIER" role="gridcell" style="display:none">ID</th>
                    <th id="nom_i" role="gridcell" width="20%">Thème</th>
                    <th id="prenom_i" role="gridcell" width="50%">Déscription</th>
                    <th id="adresse_i" role="gridcell">Encadreur</th>


                </tr>
                </thead>
                <tbody>
                <!-- on recupere les donnee du tab de la bdd -->
                <?php
                try{
                    $bdd = new PDO('mysql:host=localhost;dbname=plan;charset=utf8','root','') ;
                }catch(Exception $e){
                    echo "errreur" ;
                }

                $r = $bdd->query('SELECT * FROM enseigants RIGHT JOIN themes ON 
                                    themes.idEnseignant = enseigants.idEnseignant WHERE valide=1');
                $row_count = 1;
                while($donne=$r->fetch()){
                    ?>
                    <tr>

                        <td id="ids" role="gridcell" style="display:none"><?php echo $donne['idTheme'];?></td>
                        <td id="libelle" role="gridcell"><?php echo $donne['libelle'];?></td>
                        <td id="description" role="gridcell"><?php echo $donne['description'];?></td>
                        <td id="nomEns" role="gridcell"><?php echo $donne['nomEns'];?></td>

                    </tr>
                    <?php
                    $row_count ++ ;
                }
                ?>

                <tbody>
            </table>
        </div>
    </div>
</div>




</body>
</html>