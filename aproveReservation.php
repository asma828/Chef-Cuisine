<?php

require "./config.php";
$id = $_GET['id'];


$sql = "UPDATE Reservation SET status = 'Confirme' WHERE id = '$id'";
$query = mysqli_query($conn,$sql);
if($query){
    header("Location: Dashboard.php?success=".urlencode("Reservation confirmed successfully"));
    exit();
}
?>