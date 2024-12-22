<?php 
require "./config.php";
$id = $_GET['id'];

$sql = "delete from Reservation where id = '$id' ";
$result = mysqli_query($conn,$sql);

if($result){
    header("Location: Reservation.php?failed=".urlencode("Reservation delete succefully"));
    exit();
}

?> 