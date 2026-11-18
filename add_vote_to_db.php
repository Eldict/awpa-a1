<?php
// add_vote_to_db.php
// gets userId, vote and studentId from the vote form on student.php
// adds the vote to the database and links back to the student

include "accessControl.php";
include "dbConnect.php";

// add one vote to the votes table
function addVote($db, $userId, $vote, $studentId)
{
    $safeUserId = mysqli_real_escape_string($db, $userId);
    $safeVote = mysqli_real_escape_string($db, $vote);
    $safeStudentId = mysqli_real_escape_string($db, $studentId);

    $query = "INSERT INTO c25a1_votes (student_id, vote, user_id)
              VALUES ('$safeStudentId', '$safeVote', '$safeUserId')";

    return mysqli_query($db, $query);
}

// if the form wasn't sent I go back to the home page
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
