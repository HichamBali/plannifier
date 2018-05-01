<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 20/04/2018
 * Time: 00:36
 */
/*
session_start();

if(isset($_GET['idEtudiant']))
{$idp=$_GET['idEtudiant'];
    $_SESSION['idEtudiant']=$idp;
}
else{
    $idp=$_SESSION['idEtudiant'];
}
*/

?>

<!doctype html>
<html lang="fr">
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>liste des choix</title>

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--<link rel="stylesheet" href="/resources/demos/style.css">--> <!--là on ajoute du css à nos items..-->
    <style>
        #sortable1, #sortable2 {
            border: 1px solid #351F39;
            width: 330px;
            min-height: 20px;
            list-style-type: none;
            margin: 0;
            padding: 5px 0 0 0;
            float: left;
            margin-right: 100px;
            background-color:  #351F39;
        }

        #sortable1 li, #sortable2 li {
            margin: 0 5px 5px 5px;
            padding: 5px;
            font-size: 1.2em;
            width: 300px;


        }
        .ui-sortable li{
            background-color:#6B8E23;
            color: white;
        }

        /*fond de la page*/
        body {
            background:#F4E8C1;
            font-family: 'Open Sans', sans-serif;
        }
        button {
            /* couleur bouton*/
            background-color: #6B8E23;
            color: #351F39;

        }


    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!--Script sortable "liste fiche de voeux" -->

    <script>
        var datass;

        $(function () {
            $( "#sortable1, #sortable2" ).sortable({
                connectWith: ".connectedSortable"
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
<!-------------------------NAVBAR ----------------------->
<div class="navbar-nav navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand"><img src="images/plan.png" id="plan"> </a>
            <a href="homeEtudiant.php" role="button"><i class="fa fa-level-up"></i> Retour</a> <!--pour le retour au home-->
            <a href="logOut.php" role="button"><i class="fa fa-sign-out"></i> LogOut</a><!--pour se déconnecter-->
        </div>
    </div>
</div>

<!-----------------------Afficher liste des thèmes avec details-------------->
<br/><br/>

<h2 align="center" style="color: #2b542c"><u> Liste des thèmes proposés </u> </h2> <!--titre-->


<div class="table-responsive" id="table">

    <table id="tableTheme" role="grid" class="table table-striped table-bordered">

        <!-- le head du tableau-->
        <thead>
        <tr>
            <th id="idINFIRMIER" role="gridcell" style="display:none">ID</th>
            <th id="nom_i" role="gridcell">Thème</th>
            <th id="prenom_i" role="gridcell">Déscription</th>
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
<!---------------------------texte Indication---------------------->
<br/><br/>
<h2 align="center" style="color: #2b542c"><u> Remplir ma fiche de voeux</u></h2>
<br/>
<h4 style="color: #953b39" align="center">Indication:</h4>
<p style="color: #2b542c" align="center">
    Pour faire remplir votre fiche de voeux
    <br/> 1- faites glisser les les thèmes de la liste 1 au liste 2.
    <br/>  2- Ordonner vox choix dan la liste 2.
    <br/>  3- Cliquer sur envoyer ma fiche de voeux.
    <br/> cette dernière étape ce fait qu'une seule fois, soyez sure de vox choix et ses classement. BON COURAGE!</p><br/>


<!--------------Remplir fiche de voeux------------------>
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
        <h3 align="center" style="color: white">Glissez et ordonnez vos choix ici</h3>
    </ul>
    <button class="save" id= "btnId" onclick="savingdata()" style="color: white">Valider ma fiche de voeux</button>

</div>

</body>
</html>