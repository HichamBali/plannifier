<?php
session_start();


if(isset($_GET['idE']))
{$idE=$_GET['idE'];
    $_SESSION['idE']=$idE;
}
else{
    $idE=$_SESSION['idE'];
    header("location:homeEtudiant.php");
}

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Carlos Alvarez - Alvarez.is">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>

    <link href="css/main.css" rel="stylesheet">



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

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


    <!-- Google Fonts call. Font Used Open Sans & Raleway -->
    <link href="http://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

</head>
<body>

<!-- NAVIGATION MENU -->

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


<div class="container">
<div class="row justify-content-center">
    <div class="col-6">




        <br/><br/>
        <h2>Information binôme </h2>
        <br/>
        <br/>
        <div style="padding:3px; border:2px dashed #c0c0c0;">
            <form method="post" action="ajouterBinome.php">
<!------------------------------recuperation data bdd----------------------------------->
                <?php
                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=plan;charset=utf8', 'root', '');
                } catch (Exception $e) {
                    echo "erreur";
                }

                /**********************Information etudiant**********************/

                $r = $bdd->prepare('SELECT * FROM etudiants WHERE idUser = ?');
                $r->execute(array($idE));
                $donne=$r->fetch();



                /******info binome???? *****/



?>

                <p> Nom : <?php echo $donne['nomEtu'];?> </p>
                <p> Prénom :  <?php echo $donne['prenomEtu'];?> </p>
                <p> Nom binome : </p>
                <p> Prénom binome : </p>
                <p> Moyenne : </p>
                <p> Projet: </p>
                <p> Encadreur : </p>


            </form>
        </div>
<br/><br/>







<!--------------------------------------------CHOIX BINOME----------------------------------------------->





        <!--  test php if idEtudiant != idEtu1 et idEtu2-->

        <div style="padding:3px; border:2px dashed #c0c0c0;">

            <form class="form-inline" action="ajouterBinome.php" method="post">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Choisir binôme :</label>
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="choixEtu">
                    <?php
                    try {
                        $bdd = new PDO('mysql:host=localhost;dbname=plan;charset=utf8', 'root', '');


                    } catch (Exception $e) {
                        echo "erreur";
                    }

                    $r = $bdd->prepare('SELECT * FROM etudiants WHERE idUser != ?');
                    $r->execute(array($idE));
                    $row_count = 1;
                    while($donne=$r->fetch()){
                    ?>
                    <option value="<?php echo $donne['idEtudiant'];?>"> <?php echo $donne['nomEtu'];?>  <?php echo $donne['prenomEtu'];?></option>
                        <?php
                        $row_count ++ ;
                   }
                    ?>
                </select>


<!--------------------------------------btn valider binome---------------------------------------->
                <input type="submit" value="Valider binôme" class="btn-success" align="center"/>







        </div>

        <br/><br/><br/>

    </div>


    </div>



</body>
</html>