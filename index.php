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

<!-- Total number of votes, kept up to date by the JavaScript below -->
<p>Total votes: <span id="totalVotes">Loading ....</span></p>

<!-- Menus to choose how the list is sorted. Changing a menu or clicking
     Refresh loads the list again with Ajax. -->
<p>
    <select id="order" onchange="loadStudents()">
        <option value="id">Default Order by id</option>
        <option value="average">Order by Average Vote</option>
        <option value="count">Order by Vote Count</option>
    </select>

    <select id="direction" onchange="loadStudents()">
        <option value="asc">Ascending</option>
        <option value="desc">Descending</option>
    </select>

    <button id="refresh" onclick="loadStudents()">Refresh</button>
</p>

<!-- The student list is put in here by the JavaScript below -->
<div id="studentView">Loading ....</div>

<?php include "footer.php"; ?>

<script>
/* the Ajax request object (global so the callback function can use it) */
var x;

/* Turns the menus and the Refresh button off (true) or back on (false),
   so the user can't send another request while one is loading */
function setControlsDisabled(disabled)
{
    document.getElementById("order").disabled = disabled;
    document.getElementById("direction").disabled = disabled;
    document.getElementById("refresh").disabled = disabled;
}

/* Asks getstudents.php for the list of students, sorted the way
   the two menus say */
function loadStudents()
{
    var order = document.getElementById("order").value;
    var direction = document.getElementById("direction").value;

    document.getElementById("studentView").innerHTML = "Loading ....";
    setControlsDisabled(true);

    x = new XMLHttpRequest();

    x.open("GET", "getstudents.php?order=" + order + "&direction=" + direction);

    x.onreadystatechange = handleStudentsResponse;

    x.send(null);
}

/* Called when the server replies. Puts the students into the page
   and turns the menus and button back on. */
function handleStudentsResponse()
{
    if (x.readyState == 4 && x.status == 200)
    {
        document.getElementById("studentView").innerHTML = x.responseText;
        setControlsDisabled(false);
    }
}

/* the Ajax request object for the total votes (separate from x so the two
   requests don't get mixed up when they happen at the same time) */
var statRequest;

/* Asks getstat.php for the total number of votes */
function loadTotalVotes()
{
    statRequest = new XMLHttpRequest();

    statRequest.open("GET", "getstat.php");

    statRequest.onreadystatechange = handleTotalVotesResponse;

    statRequest.send(null);
}

/* Called when the server replies. Puts the total into the page. */
function handleTotalVotesResponse()
{
    if (statRequest.readyState == 4 && statRequest.status == 200)
    {
        document.getElementById("totalVotes").innerHTML = statRequest.responseText;
    }
}

/* load the students as soon as the page is ready */
loadStudents();

/* load the total votes now, then again every 2 seconds (2000 milliseconds) */
loadTotalVotes();
setInterval(loadTotalVotes, 2000);
</script>

</body>
</html>
