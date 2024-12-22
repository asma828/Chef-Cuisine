<?php

require "./config.php";

$id = $_GET['id'];

$sql = "UPDATE Reservation SET status = 'Anuller' WHERE id = '$id' ";
$query = mysqli_query($conn,$sql);


if($query){
    header("Location: Dashboard.php?anuller=".urlencode("Reservation annuler successfully"));
    exit();
}
?>