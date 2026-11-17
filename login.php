<?php
/* login.php
   Shows the login form. The form sends the login and password
   (using POST) to processlogin.php, which checks them. */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h1>Student Profiles - Login</h1>

<form action="processlogin.php" method="post">

    <p>
        Login:
        <input type="text" name="login">
    </p>

    <p>
        Password:
        <input type="password" name="password">
    </p>

    <p>
        <input type="submit" value="Log in">
    </p>

</form>

</body>
</html>
