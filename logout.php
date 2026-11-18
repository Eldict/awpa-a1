<?php
// logout.php
// logs the user out

session_start();

$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logged out</title>
</head>
<body>

<h1>You have been logged out</h1>

<p><a href="login.php">Log in again</a></p>

</body>
</html>
