<?php
if(isset($_POST["id"]))
{
    $connect = mysqli_connect("localhost", "root", "", "plan&go");
    $query = "SELECT * FROM themes WHERE themes.idTheme = '" . $_POST["id"] . "'";
    $result = mysqli_query($connect, $query);
    echo json_encode(mysqli_fetch_array($result));
    }

?>