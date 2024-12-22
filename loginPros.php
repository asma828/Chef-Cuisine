<?php
session_start();
require "./config.php";

$email = trim(htmlspecialchars($_POST['email']));
$password =trim(htmlspecialchars($_POST['password']));

$sql = "select * from client where email = ?";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"s",$email);

if(mysqli_stmt_execute($stmt)){
    // get the result of query (return object)
    $result = mysqli_stmt_get_result($stmt);
    if($result && mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        // for the admin i enter a simple password
        if($user['RoleId'] == 1){
            if ($password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = 'admin';
                header("Location: Dashboard.php");
                exit();
            } else {
                // Incorrect password
                header("Location: login.php?error=" . urlencode("Incorrect password for admin. Please try again."));
                exit();
            }
        }
        // i do this for the users because i enter a hashed password for them
        else{
            if(isset($user['password']) && password_verify($password,$user['password'])){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = 'user';
                header("Location: Home.php");
                exit();
            } else {                 
                header("Location: login.php?error=" . urlencode("Incorrect password. Please try again."));
                exit();
            }         
        }     
    } else {         
        header("Location: login.php?error=" . urlencode("No account found with this email. Please try again."));
        exit();
    } 
} else {     
    header("Location: login.php?error=" . urlencode("An error occurred during login. Please try again later."));
    exit();
}

