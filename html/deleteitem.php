<?php 
session_start();
include 'connection.php';
$user = $_SESSION["user"];
$id = $_POST["ID"];
$sql = "DELETE FROM contacts WHERE Id = $id AND user='$user'";
$conn->query($sql);
header("Location: main.php");
exit();
?>