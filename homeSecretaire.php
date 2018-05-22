<?php
session_start();
if(empty($_SESSION['username']))
{
    // Si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location:login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet" id="bootstrap-css">

    <link rel="stylesheet" href="homeSecretaire.css"/>
    <link rel='stylesheet prefetch' href='http://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css'>


    <script src="js/jquery.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />');
            else $('head > link').filter(':first').replaceWith(defaultCSS);
        }
        $( document ).ready(function() {
            var iframe_height = parseInt($('html').height());
            window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
        });
    </script>

</head>
<body>

<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a><!--on peut ajouter un logo-->
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

                    <li><a  role="button" href="logOut.php"><i class="fa fa-sign-out"></i> Déconnexion </a>

                    </li>
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>

<!-- /Header -->

<!-- Main -->

<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">

    <ul class="nav nav-pills nav-stacked" style="border-right:1px solid black">

        <li>
            <a href="listeEtudiantTeste.php"><i class="fa fa-dashboard"></i> Tableau de bord</a>
        </li>


        <li>
            <a href="afficherAFF.php"><i class="fa fa-check-circle"></i> Affectation </a>
        </li>
        <li>
            <a href=""><span class="fa fa-university"></span> Soutenance </a>

        </li>
        <li>
            <a href="listeEtudiantTeste.php"><i class="fa fa-archive"></i> Liste Etudiants</a>
        </li>
        <li>
            <a href="listeEnseignants.php" data-toggle="collapse" data-target="#submenu-3"><i class="fa fa-archive"></i> Liste Enseignants</a>
        </li>


    </ul>
</div>



