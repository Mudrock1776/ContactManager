<html>
    <body>
        <!-- The Form below is for returning users, it uses the post method which means the data does not appear on the url the action sends the user to login.php -->
        <form action="login.php" method="post">
            username: <input type="text" name="username"><br>
            password: <input type="text" name="password"><br>
            <input type="submit">
        </form>
        <!-- The Form below is for new users it works the exact same way existing users work it just sends them to newUser.php instead -->
        <form action="newUser.php" method="post">
            New username: <input type="text" name="NewUser"><br>
            New password: <input type="text" name="password"><br>
            <input type="submit">
        </form>

        <?php 
        if(isset($_GET["error"])){ //this line checks to see if the user enter an invalid user via the get method, which means that in the url you will see ?error=<something>
            echo 'invalid user';
        }
        if(isset($_GET["newuser"])){ //same as before just uses a diffrent variable these 2 if statements can be combined into one
            echo 'username taken';
        }
        ?>
    </body>
</html>