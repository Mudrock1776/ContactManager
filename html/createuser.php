<?php 
include 'connection.php';
session_start();

$user = $_POST["username"];
$pass = $_POST["password"];

if(strpos($user,"--") or strpos($pass,"--")){
    header("Location: index.php?error=SQL injection is not allowed");
    exit();
}

$sql = "SELECT * FROM users WHERE username='$user'";
$results = $conn->query($sql);
if($results->num_rows == 0){
    $_SESSION["user"] = $user;
    $sql = "INSERT INTO users VALUES ('$user','$pass')";
    $conn->query($sql);
    header("Location: main.php");
    exit();
} else {
    header("Location: index.php?error=taken username");
    exit();
}
?>