<?php
session_start();
if (empty($_SESSION['username'])) {
    header('Location:login.html');
    exit();
}
$idEnseignant = $_SESSION['idEnseignant'];
?>


<!doctype html>
<html><head>
    <meta charset="utf-8">
    <title>BLOCKS - Bootstrap Dashboard Theme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Carlos Alvarez - Alvarez.is">

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />

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

    <style type="text/css">
        body {
            padding-top: 60px;
        }


                    .dash-unit:hover {
    background-color: #9EFCB4;
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
  
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
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
        </div>  <!--/.nav-collapse -->
    </div>
</div>
<br/><br/><br/><br/>
<br/><br/>


<div class="container">

    <!-- FIRST ROW OF BLOCKS -->
    <div class="row">

        <!-- Proposer sujet -->
        <div class="col-sm-3 col-lg-3">
            <div class="dash-unit">

                <dtitle>Proposer thème</dtitle>

                <div class="thumbnail">
                    <a class="navbar-brand" href="themes.php?idEns=<?php echo $_SESSION['idEnseignant'];?>">
                        <img src="images/file.png" id="info"  class="img-circle"> </a>
                </div>

            </div>
        </div>


        <!-- Consulter thèmes validés -->
        <div class="col-sm-3 col-lg-3">
            <div class="dash-unit">

                <dtitle>Thèmes validés</dtitle>

                <div class="thumbnail">
                    <a class="navbar-brand" href="themesValide.php">
                        <img src="images/theme.png" id="info"  class="img-circle"> </a>
                </div>

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

        <!----------------------Avancement Binôme-------------------------->
        <div class="col-sm-3 col-lg-3">
            <div class="dash-unit">

                <dtitle>Avancement binôme</dtitle>

                <div class="thumbnail">
                    <a class="navbar-brand" href="#">
                        <img src="images/avancement.png" id="info"  class="img-circle"> </a>
                </div>

            </div>
        </div>


</body></html>