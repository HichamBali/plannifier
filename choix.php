<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 20/04/2018
 * Time: 00:36
 */

session_start();

if(isset($_GET['idE']))
{$idE=$_GET['idE'];
    $_SESSION['idE']=$idE;
}
else{
    $idE=$_SESSION['idE'];
}


?>

<!doctype html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Carlos Alvarez - Alvarez.is">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>

    



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

   

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


    <!-- Google Fonts call. Font Used Open Sans & Raleway -->
    <link href="http://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
    <!--<link rel="stylesheet" href="/resources/demos/style.css">--> <!--là on ajoute du css à nos items..-->
    <style>
         body {
      
    background:#fcfcee;
    font-family: 'Open Sans', sans-serif;


            padding-top: 60px;
        }
      .navbar-nav {
        background-color: #f4e8c1;
      }








        #sortable1, #sortable2 {
            border: 1px solid #c0c0c0;
            width: 330px;
            min-height: 20px;
            list-style-type: none;
            margin: 0;
            padding: 5px 0 0 0;
            float: left;
            margin-right: 100px;
            background-color:  #f4e8c1;
            color: black;
        }

        #sortable1 li, #sortable2 li {
            margin: 0 5px 5px 5px;
            padding: 5px;
            font-size: 1.2em;
            width: 300px;


        }
        .ui-sortable li{
            background-color: #F5F5F5;

            color: black;
        }

        /*fond de la page*/
        body {
            background:#fcfcee;
            font-family: 'Open Sans', sans-serif;
        }
        button {
            /* couleur bouton*/
            background-color: #59C6C3;


        }


    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!--Script sortable "liste fiche de voeux" -->

    <script>
        var datass;

        $(function () {
            $( "#sortable1, #sortable2" ).sortable({
                connectWith: ".connectedSortable",

            }).disableSelection();

            $("#sortable2").on("sortreceive sortupdate", function (event, ui) {



                if ($("#sortable2 li").length <= 4) { //pour limiter les choix à 4 max

                    datass = $(this).sortable('serialize');
                    console.log(datass);

                }
                else $(ui.sender).sortable('cancel');


            });

        });

    </script>
    <!-- Enregistrement data avec ajax et json -->
    <script>
        function savingdata(){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "ajouterChoix.php", // ajouter à la bdd
                data: {lists: datass},
                success: function(result){
                    if(result.trim()=="success")
                        alert("Votre fiche de voeux est bien enregistrée, Bon courage!");
                    $('#btnId').attr('disabled', 'true');// btn cliquable qu'une seule fois
                    document.getElementById('btnId').style.backgroundColor = "gray"; // changer couleur btn
                    document.getElementById('btnId').style.color = "white";
                }
            });
        }

    </script>
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
            <a href="homeEtudiant.php"class="navbar-brand pull-right" ><strong class="fa fa-arrow-circle-o-left"> Retour</strong></a>
        </div>  <!--/.nav-collapse -->
    </div>
</div>

<!-----------------------Afficher liste des thèmes avec details-------------->
<br/><br/>

<h2 align="center" style="color: #79D54C"><u> Liste des thèmes proposés </u> </h2> <!--titre-->

<br/><br/>
<div class="row justify-content-center">
    <div class="col-8">
<div class="table-responsive" id="table">

    <table id="tableTheme" role="grid" class="table table-striped table-bordered" style="border: 1px solid #c0c0c0">

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
<!---------------------------texte Indication---------------------->

<div class="row justify-content-center">
<div class="col-10">




    <br/><br/>
    <h2 align="center" style="color: #79D54C"><u> Remplir ma fiche de voeux</u></h2>
    <br/>
    <br/>
    <div style="padding:3px; border:1px dashed #c0c0c0;">
        <strong style="color: #953b39">Indication:</strong>:  Pour  remplir votre fiche de voeux
        <br/>  1- faites glisser les les thèmes de la liste 1 à la  liste 2.
        <br/>  2- Ordonner vos choix dans la 2eme liste.
        <br/>  3- Cliquer sur envoyer ma fiche de voeux.
        <br/>
        <br/> ATTENTION La dernière étape ce fait qu'une seule fois,  BON COURAGE!
    </div>

    <br/><br/><br/>




</div>
</div>

<!--------------Remplir fiche de voeux------------------>
<div class="row justify-content-center">
    <div class="col-10">

<div>
    <ul id="sortable1">

        <?php                    // on récupère les thèmes validés de la bdd
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=plan;charset=utf8', 'root', '');
        } catch (Exception $e) {
            echo "erreur";
        }

        $r = $bdd->query('SELECT * FROM themes WHERE valide = 1'); // Tous les thèmes validés

        $row_count = 1;
        while ($donne = $r->fetch()) {
            ?>

            <li class="ui-state-default"  id="item_<?php echo $donne['idTheme'];?>" name="idTheme" ><?php echo $donne['libelle']; ?></li>



            <?php
            $row_count++;
        }
        ?>
    </ul>
    <ul id="sortable2" class="connectedSortable">
        <h3 align="center" style="color: black">Glissez et ordonnez vos choix ici</h3>
    </ul>

</div>


    </div>
</div>
<div class="row justify-content-center">
<div class="col-8" align="right">
    <button class="save" id= "btnId" onclick="savingdata()" style="color: black">Valider</button>
</div>
</body>


</body>
</html>