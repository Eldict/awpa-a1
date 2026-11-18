<?php
// index.php
// home page, the student list is loaded with ajax from getstudents.php

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

<!-- total votes, updated every 2 seconds -->
<p>Total votes: <span id="totalVotes">Loading ....</span></p>

<!-- order and direction menus and refresh button -->
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

<!-- student list goes here -->
<div id="studentView">Loading ....</div>

<?php include "footer.php"; ?>

<script>
// ajax request for the student list
var x;

// turn the menus and button off or on while loading
function setControlsDisabled(disabled)
{
    document.getElementById("order").disabled = disabled;
    document.getElementById("direction").disabled = disabled;
    document.getElementById("refresh").disabled = disabled;
}

// get the student list from getstudents.php using the menus
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

// put the student list in the page and turn the menus back on
function handleStudentsResponse()
{
    if (x.readyState == 4 && x.status == 200)
    {
        document.getElementById("studentView").innerHTML = x.responseText;
        setControlsDisabled(false);
    }
}

// separate ajax request for the total votes
var statRequest;

// get the total votes from getstat.php
function loadTotalVotes()
{
    statRequest = new XMLHttpRequest();

    statRequest.open("GET", "getstat.php");

    statRequest.onreadystatechange = handleTotalVotesResponse;

    statRequest.send(null);
}

// put the total votes in the page
function handleTotalVotesResponse()
{
    if (statRequest.readyState == 4 && statRequest.status == 200)
    {
        document.getElementById("totalVotes").innerHTML = statRequest.responseText;
    }
}

// load the list when the page opens
loadStudents();

// how often I refresh the total votes, in milliseconds
var refreshTime = 2000;

// load total votes now and then again every refreshTime
loadTotalVotes();
setInterval(loadTotalVotes, refreshTime);
</script>

</body>
</html>
