<?php 

require "./config.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $reservationId = $_POST['reservation_id'];
    $date = $_POST['dateReservation'];
    $time = $_POST['heur'];
    $Nperson = $_POST['nbrPerson'];

    $sql = "update Reservation set dateReservation = ? , heur = ? , nbrPerson = ? where id = ?";

    $stmt = mysqli_prepare($conn,$sql);

    mysqli_stmt_bind_param($stmt,"ssii",$date,$time,$Nperson,$reservationId);

    if(mysqli_stmt_execute($stmt)){
        header("Location: Reservation.php?success=1");
    }
    else{
        header("Location: Reservation.php?error=1");
    }
}

?>