<?php
/* add_vote_to_db.php
   Receives a vote from the form on student.php (GET): userId, vote and studentId.
   Adds the vote to the c25a1_votes table, says it was added and links back
   to that student's page. */

include "accessControl.php";
include "dbConnect.php";

/* Adds one vote to the votes table. Returns true if it worked. */
function addVote($db, $userId, $vote, $studentId)
{
    /* escape the values so they can't break the SQL query */
    $safeUserId = mysqli_real_escape_string($db, $userId);
    $safeVote = mysqli_real_escape_string($db, $vote);
    $safeStudentId = mysqli_real_escape_string($db, $studentId);

    $query = "INSERT INTO c25a1_votes (student_id, vote, user_id)
              VALUES ('$safeStudentId', '$safeVote', '$safeUserId')";

    return mysqli_query($db, $query);
}

/* If the form wasn't sent, go back to the home page */
if (!isset($_GET['userId']) || !isset($_GET['vote']) || !isset($_GET['studentId']))
{
    header("Location:index.php");
    exit();
}

$studentId = $_GET['studentId'];
$added = addVote($db, $_GET['userId'], $_GET['vote'], $studentId);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vote</title>
</head>
<body>

<?php
if ($added)
{
    echo "<h1>Your vote was added</h1>";
}
else
{
    echo "<h1>Sorry, your vote could not be added</h1>";
}

echo "<p><a href='student.php?id=" . $studentId . "'>Back to the student</a></p>";

include "footer.php";
?>

</body>
</html>
