<?php
include "connection.php";
session_start();
$user = $_SESSION["user"];
$id = $_POST["ID"];

if (isset($_POST["FirstName"]) and isset($_POST["LastName"]) and isset($_POST["email"]) and isset($_POST["phonenumber"])) {
    $firstname = $_POST["FirstName"];
    $lastname = $_POST["LastName"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];

    $sql = "UPDATE contacts SET FirstName='$firstname', LastName='$lastname', Email='$email', PhoneNumber='$phonenumber' WHERE Id = $id AND user='$user'";
    $conn->query($sql);
    header("Location: main.php");
    exit();
}

$sql = "SELECT * FROM contacts WHERE Id=$id and user='$user'";
$results = $conn->query($sql);
if ($results->num_rows == 0){
    header("Location: main.php");
    exit();
}
$row = $results->fetch_assoc();
?>
<html>
    <body>
        <form action="" method="post">
            FirstName: <input type="text" name="FirstName" value="<?php echo $row["FirstName"]; ?>"><br>
            LastName: <input type="text" name="LastName" value="<?php echo $row["LastName"]; ?>"><br>
            email: <input type="text" name="email" value="<?php echo $row["Email"]; ?>"><br>
            phone number: <input type="text" name="phonenumber" value="<?php echo $row["PhoneNumber"]; ?>"><br>
            <button type="submit" value="<?php echo $id;?>" name="ID">Submit</button>
        </form>
    </body>
</html>