<?php 
include 'connection.php';
session_start();
$user = $_POST['username'];
$password = $_POST['password'];

if(empty($user) or empty($password)){
    header("Location: index.php?error=username/password must be filled in");
    exit();
}
if(strpos($user, "--") or strpos($password, "--")){
    header("Location: index.php?error=SQL injection is not allowed");
    exit();
}
$sql = "SELECT * FROM users WHERE username='$user' AND password='$password'";
$result = $conn->query($sql);
if ($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $_SESSION["user"] = $row["username"];
    header("Location: main.php");
    exit();
} else {
    header("Location: index.php?error=Invalid username or password");
    exit();
}
?>