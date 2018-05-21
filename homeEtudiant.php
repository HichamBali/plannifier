<?php
session_start();
if (empty($_SESSION['username'])) {
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location:login.html');
    exit();
}
// recuperer idEtudiant
$idEtudiant = $_SESSION['idEtudiant'];
?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Carlos Alvarez - Alvarez.is">

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
                    <a class="navbar-brand" href="info.php"><img src="images/info.png" id="info"  class="img-circle"> </a>
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

                <h2>45%</h2>
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