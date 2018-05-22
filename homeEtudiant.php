<?php
session_start();
if (empty($_SESSION['username'])) {
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location:login.html');
    exit();
}
// recuperer idEtudiant
$idEtu = $_SESSION['idEtudiant'];

$connexionDB = new PDO("mysql:host=localhost;dbname=plan&go", "root", "");
$connexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$r = $connexionDB->prepare('SELECT * FROM etudiants WHERE idUser=?');
$r->execute(array($idEtu));
$donne=$r->fetch();
$idEtud = $donne['idEtudiant'];

$m = $connexionDB->prepare('SELECT * FROM binomes WHERE idEtudiant1 = ? OR idEtudiant2 = ?');
$m->execute(array($idEtud, $idEtud));
$donne=$m->fetch();
$idBinome = $donne['idBinome'];

$n =  $connexionDB->prepare('SELECT tauxAvancement FROM avancements WHERE idBinome = ?');
$n->execute(array($idBinome));
$donne=$n->fetch();
$tauxAvancement = $donne['tauxAvancement'];
?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>

    <link href="css/main.css" rel="stylesheet">
    <link href="css/font-style.css" rel="stylesheet">
    <link href="css/flexslider.css" rel="stylesheet">

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

    <!-- <style type="text/css">
        body {
         background-color: #C3654B ;
         //   background-color:#6F9130 ;

            padding-top: 60px;
        }
        .navbar-nav{
         //   background-color: #C3654B ;
            background-color: #C3654B ;

        }
    </style> -->
       <style >
                    .dash-unit:hover {
    background-color: #71dd8a;
    -moz-box-shadow:    3px 3px 2px 0px #151515;
    -webkit-box-shadow: 3px 3px 2px 0px #151515;
    box-shadow:         3px 3px 2px 0px #79D54C;

}
.dash-unit {
    margin-bottom: 30px;
    padding-bottom:10px;
    border: 1px solid #eadcb2;
    /*background-image:url('../images/sep-half.png');*/
    background-color: #F4E8C1;
    color:black;
    height:290px;
}

.dash-unit dtitle {
    font-size:11px;
    text-transform:uppercase;
    color:black;
    margin:8px;
    padding:0px;
    height:inherit
    }

    .half-unit {
    margin-bottom: 30px;
    padding-bottom: 4px;
    border: 1px solid #eadcb2;
    /*background-image:url('../images/sep-half.png');*/
    background-color: #F4E8C1;
    color:white;
    height:130px;
}

.half-unit:hover {
    background-color: #9EFCB4;
    -moz-box-shadow:    3px 3px 2px 0px #151515;
    -webkit-box-shadow: 3px 3px 2px 0px #151515;
    box-shadow:         3px 3px 2px 0px #79D54C;

}
.half-unit dtitle {
    font-size:10px;
    text-transform:uppercase;
    color:black;
    margin:8px;
    padding:0px;
    height:inherit
    }
.progress-bar {
    background-color:#59C6C3;
}


                </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


    <!-- Google Fonts call. Font Used Open Sans & Raleway -->
    <link href="http://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

    <script type="text/javascript">
        $(document).ready(function () {

            $("#btn-blog-next").click(function () {
                $('#blogCarousel').carousel('next')
            });
            $("#btn-blog-prev").click(function () {
                $('#blogCarousel').carousel('prev')
            });

            $("#btn-client-next").click(function () {
                $('#clientCarousel').carousel('next')
            });
            $("#btn-client-prev").click(function () {
                $('#clientCarousel').carousel('prev')
            });

        });

        $(window).load(function () {

            $('.flexslider').flexslider({
                animation: "slide",
                slideshow: true,
                start: function (slider) {
                    $('body').removeClass('loading');
                }
            });
        });

    </script>
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
        </div>  <!--/.nav-collapse -->
    </div>
</div>

<div class="container">
<br/><br/> <br/><br/><br/><br/><br/><br/><br/>
    <!-- FIRST ROW OF BLOCKS -->
    <div class="row">

        <!-- USER PROFILE BLOCK -->
        <!--INFORMATION UTILISATEURS-->
        <div class="col-sm-3 col-lg-3">
            <div class="dash-unit">
                <dtitle>Informations binôme</dtitle>

                <div class="thumbnail">
                    <a class="navbar-brand" href="info.php?idE=<?php echo $_SESSION['idEtudiant'];?>"><img src="images/info.png" id="info"  class="img-circle"> </a>
                </div>

            </div>
        </div>
        <!---------------------------AVANCEMENT PROJET----------------------->
        <!-- DONUT CHART BLOCK -->
        <div class="col-sm-3 col-lg-3">
            <div class="dash-unit">
             
                <dtitle>Taux Avancement du projet</dtitle>
                <br/>  <br/>  <br/>
                <div id="load"></div>




                <h2> <?php echo "$tauxAvancement"?>%</h2>
                <br/>

            </div>
        </div>


        <!------------------------------------VOIR PLANNING------------------------------------->
        <div class="col-sm-3 col-lg-3">
            <div class="dash-unit">
                <dtitle>Consulter Planning</dtitle>
                <div class="thumbnail">
                    <a class="navbar-brand" href="planning.html"><img src="images/planning.png" class="img-circle id="planning"> </a>
                </div>
            </div><!-- /dash-unit -->

        </div><!-- /row -->
<!-------------------------CHOISIR THEME------------------------------>
            <div class="col-sm-3 col-lg-3">
                <div class="dash-unit">
                    <dtitle>Liste de themes</dtitle>
                    <div class="thumbnail">
                        <a class="navbar-brand" href="choix.php?idE=<?php echo $_SESSION['idEtudiant'];?>"><img src="images/check.png" id="planning"> </a>
                    </div>

                </div>
            </div>




</body>
</html>