<?php 
$server = 'localhost';
$account = 'Cormac';
$password = 'Blood1985Meridian';
$database = 'website';

$conn = new mysqli($server,$account,$password,$database);

if($conn->connect_error){
    die("Connection to database failed: ".$conn->connect_error);
}
?>