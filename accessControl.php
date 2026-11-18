<?php
// accessControl.php
// include at the top of every page that needs login
// if not logged in, go to login page

session_start();

if (!isset($_SESSION['loggedin']))
{
    header("Location:login.php");
    exit();
}
?>
