<?php
/* index.php
   Home page. Only logged in users can see it.
   The list of students is loaded with Ajax from getstudents.php. */

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

<!-- The student list is put in here by the JavaScript below -->
<div id="studentView">Loading ....</div>

<?php include "footer.php"; ?>

<script>
/* the Ajax request object (global so the callback function can use it) */
var x;

/* Asks getstudents.php for the list of students */
function loadStudents()
{
    x = new XMLHttpRequest();

    x.open("GET", "getstudents.php");

    x.onreadystatechange = handleStudentsResponse;

    x.send(null);
}

/* Called when the server replies. Puts the students into the page. */
function handleStudentsResponse()
{
    if (x.readyState == 4 && x.status == 200)
    {
        document.getElementById("studentView").innerHTML = x.responseText;
    }
}

/* load the students as soon as the page is ready */
loadStudents();
</script>

</body>
</html>
