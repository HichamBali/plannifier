<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 20/04/2018
 * Time: 00:36
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

    <!--<link rel="stylesheet" href="/resources/demos/style.css">--> <!--là on ajoute du css à nos items..-->
    <style>
        #sortable1, #sortable2 {
            border: 1px solid #eee;
            width: 330px;
            min-height: 20px;
            list-style-type: none;
            margin: 0;
            padding: 5px 0 0 0;
            float: left;
            margin-right: 100px;
        }

        #sortable1 li, #sortable2 li {
            margin: 0 5px 5px 5px;
            padding: 5px;
            font-size: 1.2em;
            width: 300px;
        }

    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    <script>
        function savingdata(){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "ajouterChoix.php",
                data: {lists: datass},
                success: function(result){
                    if(result.trim()=="success")
                        alert("add success");

                }
            });
        }
    </script>
</head>
<body>
<h3 align="left">Thèmes à choisir</h3>
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



<h3 align="center">Glissez vos choix ici</h3>

<ul id="sortable2" class="connectedSortable">
</ul>
<button class="save" onclick="savingdata()">Valider</button>

</body>
</html>