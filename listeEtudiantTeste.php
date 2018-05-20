<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.css">
</head>
<body>
<?php
include "homeSecretaire.php";
?>

<div class="container col-md-10">
    <table id="myTable" class="table table-bordered">
    <thead>
    <tr>
        <th id="idEtudiant" role="gridcell" style="display:none">ID</th>
        <th id="nomEtu" role="gridcell">Nom</th>
        <th id="prenomEtu" role="gridcell">prenom</th>
        <th id="adresseEtu" role="gridcell">Adresse</th>
        <th id="anneeEtu" role="gridcell">annee</th>
        <th id="specialiteEtu" role="gridcell">spec</th>
        <th id="moyenneEtu" role="gridcell">moyenneEtu</th>

    </tr>
    </thead>
    <tfoot></tfoot>
    <tbody><tr><td id="idEtudiant" role="gridcell" style="display:none">ID</td>
    <td id="nomEtu" role="gridcell">Nom</td>
    <td id="prenomEtu" role="gridcell">prenom</td>
    <td id="adresseEtu" role="gridcell">Adresse</td>
    <td id="anneeEtu" role="gridcell">annee</td>
    <td id="specialiteEtu" role="gridcell">spec</td>
    <td id="moyenneEtu" role="gridcell">moyenneEtu</td></tr></tbody>


</table>
</div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script>

</script>
</html>


<?php

?>