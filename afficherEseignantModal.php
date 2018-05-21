<?php
if(isset($_POST["id"]))
{
$output = '';
$connect = mysqli_connect("localhost", "root", "", "service");
$query = "SELECT * FROM medecin WHERE medecin.idMEDECIN = '" . $_POST["id"] . "'";
$result = mysqli_query($connect, $query);
echo json_encode(mysqli_fetch_array($result));


}?>