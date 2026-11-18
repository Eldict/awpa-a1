<?php
// student.php
// shows one student, the id comes from the url (student.php?id=3)

include "accessControl.php";
include "dbConnect.php";
include "voteDisplay.php";

// get the student with this id
function getStudent($db, $id)
{
    $safeId = mysqli_real_escape_string($db, $id);

    $query = "SELECT id, image, address, mark, student_id
              FROM c25a1_students WHERE id = '$safeId'";

    $result = mysqli_query($db, $query);

    return mysqli_fetch_array($result);
}

// get the previous student (next smaller id)
function getPreviousStudent($db, $id)
{
    $query = "SELECT id, student_id FROM c25a1_students
              WHERE id < $id ORDER BY id DESC LIMIT 1";

    $result = mysqli_query($db, $query);

    return mysqli_fetch_array($result);
}

// get the next student (next bigger id)
function getNextStudent($db, $id)
{
    $query = "SELECT id, student_id FROM c25a1_students
              WHERE id > $id ORDER BY id ASC LIMIT 1";

    $result = mysqli_query($db, $query);

    return mysqli_fetch_array($result);
}

// get the average vote and vote count for this student
function getStudentVotes($db, $id)
{
    $query = "SELECT AVG(vote) AS average, COUNT(vote) AS count
              FROM c25a1_votes WHERE student_id = $id";

    $result = mysqli_query($db, $query);

    return mysqli_fetch_array($result);
}

// get the logged in user's vote for this student
function getUserVote($db, $studentId, $userId)
{
    $query = "SELECT vote FROM c25a1_votes
              WHERE student_id = $studentId AND user_id = $userId";

    $result = mysqli_query($db, $query);

    return mysqli_fetch_array($result);
}

// vote form, sends userId, studentId and vote to add_vote_to_db.php
function showVoteForm($studentId, $userId, $maxVote)
{
    echo "<form action='add_vote_to_db.php' method='GET'>";
    echo "<input type='hidden' name='userId' value='$userId'>";
    echo "<input type='hidden' name='studentId' value='$studentId'>";
    echo "Your vote: <select name='vote'>";

    for ($vote = 0; $vote <= $maxVote; $vote++)
    {
        echo "<option value='$vote'>$vote</option>";
    }

    echo "</select> ";
    echo "<input type='submit' value='Vote'>";
    echo "</form>";
}

// show stars and vote count, then the user's vote or the vote form
function showVotes($db, $studentId, $userId, $maxVote)
{
    $votes = getStudentVotes($db, $studentId);

    echo "<p>" . makeStarsHtml($votes['average']) . "<br>" . makeVoteCountText($votes['count']) . "</p>";

    $userVote = getUserVote($db, $studentId, $userId);

    if ($userVote)
    {
        echo "<p>Your vote: " . $userVote['vote'] . "</p>";
    }
    else
    {
        showVoteForm($studentId, $userId, $maxVote);
    }
}

// previous and next links, left out if there is no student
function showPreviousNextLinks($previous, $next)
{
    echo "<p>";

    if ($previous)
    {
        echo "<a href='student.php?id=" . $previous['id'] . "'>Previous: " . $previous['student_id'] . "</a>";
    }

    if ($previous && $next) echo " | ";

    if ($next)
    {
        echo "<a href='student.php?id=" . $next['id'] . "'>Next: " . $next['student_id'] . "</a>";
    }

    echo "</p>";
}

// highest vote someone can give
$maxVote = 5;

// student id from the url
$id = "";
if (isset($_GET["id"])) $id = $_GET["id"];

$student = getStudent($db, $id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
</head>
<body>

<p>Logged in as: <?php echo $_SESSION['userName']; ?></p>

<?php
if ($student)
{
    echo "<h1>Student " . $student['student_id'] . "</h1>";
    echo "<img src='avatars/" . $student['image'] . "' alt='Student " . $student['student_id'] . "'>";
    echo "<p>Student id: " . $student['student_id'] . "</p>";
    echo "<p>Address: " . $student['address'] . "</p>";
    echo "<p>Mark: " . $student['mark'] . "</p>";

    showVotes($db, $student['id'], $_SESSION['userId'], $maxVote);

    $previous = getPreviousStudent($db, $student['id']);
    $next = getNextStudent($db, $student['id']);
    showPreviousNextLinks($previous, $next);
}
else
{
    echo "<h1>Student not found</h1>";
}

include "footer.php";
?>

</body>
</html>
