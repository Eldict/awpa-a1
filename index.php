<?php
/* index.php
   Home page. Only logged in users can see it. */

include "accessControl.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Profiles</title>
</head>
<body>

<h1>Student Profiles</h1>

<p>Logged in as: <?php echo $_SESSION['userName']; ?></p>

<?php include "footer.php"; ?>

</body>
</html>
