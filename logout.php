<?php
/* logout.php
   Ends the session (logs the user out) and links back to the login page. */

session_start();

/* delete all the session variables */
$_SESSION = array();

/* end the session */
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
