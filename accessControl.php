<?php
/* accessControl.php
   Include this at the very top of every page that needs a login.
   If the user is not logged in it sends them to the login page.
   (It must come before any HTML so the redirect header can be sent.) */

session_start();

if (!isset($_SESSION['loggedin']))
{
    header("Location:login.php");
    exit();
}
?>
