<?php
require "./config.php";
$id=$_GET['id'];
$sql="delete from plat where id='$id'";
$result=mysqli_query($conn,$sql);
if($result){
    header("location: MenuDash.php?remove=".urlencode('Menu remove secceseflly'));
    exit();
}
?>