<?php
// dbConnect.php
// connects to the database, included by every page that uses it

// local xampp settings
$dbHost = "localhost";
$dbUser = "awpa";
$dbPassword = "awpa123";
$dbName = "awpa_a1";

// webdevcit.com settings, change to these before uploading
// $dbUser = "R00XXXXXX_db";
// $dbPassword = "your_password";
// $dbName = "R00XXXXXX_db";

$db = mysqli_connect($dbHost, $dbUser, $dbPassword);

if (mysqli_connect_error()) {
    die("Could not connect to the database: " . mysqli_connect_error());
}

mysqli_select_db($db, $dbName);
mysqli_set_charset($db, "utf8");
?>
