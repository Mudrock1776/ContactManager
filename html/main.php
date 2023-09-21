<?php
include 'connection.php';
session_start();
$user = $_SESSION["user"];
if (isset($_POST["FirstName"]) and isset($_POST["LastName"]) and isset($_POST["email"]) and isset($_POST["phonenumber"])) {
    $firstname = $_POST["FirstName"];
    $lastname = $_POST["LastName"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];
    $conn->query("INSERT INTO contacts (FirstName, LastName, Email, PhoneNumber, user) VALUES ('$firstname','$lastname','$email','$phonenumber','$user')");
}
?>
<html>
    <body>
        <a href="logout.php">logout</a>
        <form action="" method="post">
            FirstName: <input type="text" name="FirstName"><br>
            LastName: <input type="text" name="LastName"><br>
            email: <input type="text" name="email"><br>
            phone number: <input type="text" name="phonenumber"><br>
            <input type="submit">
        </form>
        <form method="get">
            <input type="text" name="search"><button type="submit">Search</button>
        </form>
        <br>
        <?php 
        if(isset($_GET["search"]) and $_GET["search"] != ""){
            $search = $_GET["search"];
            $sql = "SELECT * FROM contacts WHERE user='$user' AND (firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR email LIKE '%$search%' OR phonenumber LIKE '%$search%')";
        } else {
            $sql = "SELECT * FROM contacts WHERE user='$user'";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                ?>
                First Name: <?php echo $row["FirstName"]; ?><br>
                Last Name: <?php echo $row["LastName"]; ?><br>
                Email: <?php echo $row["Email"]; ?><br>
                Phonenumber: <?php echo $row["PhoneNumber"]; ?><br>
                <form action="edititem.php" method="post">
                    <button type="submit" value="<?php echo $row["Id"];?>" name="ID">edit</button>
                </form>
                <form action="deleteitem.php" method="post">
                    <button type="submit" value="<?php echo $row["Id"];?>" name="ID">delete</button>
                </form>
                <?php
            }
        } else {
            echo "0 Results";
        }
        ?>
    </body>
</html>