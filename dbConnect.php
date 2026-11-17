<?php
/* dbConnect.php
   Connects to the database. Every page that needs the database includes this file.
   Change the 4 values below when moving from XAMPP to the webdevcit.com server. */

/* Local settings (database and user created on my own machine) */
$dbHost = "localhost";
$dbUser = "awpa";
$dbPassword = "awpa123";
$dbName = "awpa_a1";

/* webdevcit.com settings - swap these in before uploading
$dbUser = "R00XXXXXX_db";
$dbPassword = "your_password";
$dbName = "R00XXXXXX_db";
*/

$db = mysqli_connect($dbHost, $dbUser, $dbPassword);

if (mysqli_connect_error()) {
    die("Could not connect to the database: " . mysqli_connect_error());
}

mysqli_select_db($db, $dbName);
mysqli_set_charset($db, "utf8");
?>
