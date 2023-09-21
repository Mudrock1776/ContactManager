<html>
    <body>
        <form method="post" action="login.php">
            username: <input type="text" name="username"><br>
            password: <input type="text" name="password"><br>
            <input type="submit">
        </form>
        <form method="post" action="createuser.php">
            New username: <input type="text" name="username"><br>
            New password: <input type="text" name="password"><br>
            <input type="submit">
        </form>
        <?php 
        if (isset($_GET["error"])){
            echo $_GET["error"];
        }
        ?>
    </body>
</html>