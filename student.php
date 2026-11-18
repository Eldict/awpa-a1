<?php
/* student.php
   Shows the details of one student.
   The id of the student (the id field in c25a1_students) is passed in the URL,
   e.g. student.php?id=3 */

include "accessControl.php";
include "dbConnect.php";
include "voteDisplay.php";

/* Gets the student with this id from the database.
   Returns the row, or false if there is no such student. */
function getStudent($db, $id)
{
    $safeId = mysqli_real_escape_string($db, $id);

    $query = "SELECT id, image, address, mark, student_id
              FROM c25a1_students WHERE id = '$safeId'";

    $result = mysqli_query($db, $query);

    /* only one row expected, so no loop needed */
    return mysqli_fetch_array($result);
}

/* Gets the student just before this one (the next smaller id).
   Returns the row, or false if this is the first student. */
function getPreviousStudent($db, $id)
{
    $query = "SELECT id, student_id FROM c25a1_students
              WHERE id < $id ORDER BY id DESC LIMIT 1";

    $result = mysqli_query($db, $query);

    return mysqli_fetch_array($result);
}

/* Gets the student just after this one (the next bigger id).
   Returns the row, or false if this is the last student. */
function getNextStudent($db, $id)
{
    $query = "SELECT id, student_id FROM c25a1_students
              WHERE id > $id ORDER BY id ASC LIMIT 1";

    $result = mysqli_query($db, $query);

    return mysqli_fetch_array($result);
}

/* Gets the average vote and number of votes for this student.
   Returns a row with 'average' (NULL if no votes) and 'count'. */
function getStudentVotes($db, $id)
{
    $query = "SELECT AVG(vote) AS average, COUNT(vote) AS count
              FROM c25a1_votes WHERE student_id = $id";

    $result = mysqli_query($db, $query);

    return mysqli_fetch_array($result);
}

/* Gets the vote the logged in user gave this student.
   Returns the row, or false if they haven't voted for this student yet. */
function getUserVote($db, $studentId, $userId)
{
    $query = "SELECT vote FROM c25a1_votes
              WHERE student_id = $studentId AND user_id = $userId";

    $result = mysqli_query($db, $query);

    return mysqli_fetch_array($result);
}

/* Shows the form for voting: a menu with the votes 0 to 5 and a Vote button.
   The user id and student id are sent too (hidden), all by GET to add_vote_to_db.php */
function showVoteForm($studentId, $userId)
{
    echo "<form action='add_vote_to_db.php' method='GET'>";
    echo "<input type='hidden' name='userId' value='$userId'>";
    echo "<input type='hidden' name='studentId' value='$studentId'>";
    echo "Your vote: <select name='vote'>";

    for ($vote = 0; $vote <= 5; $vote++)
    {
        echo "<option value='$vote'>$vote</option>";
    }

    echo "</select> ";
    echo "<input type='submit' value='Vote'>";
    echo "</form>";
}

/* Shows the student's average stars and vote count, then either the logged in
   user's own vote, or the vote form if they haven't voted for this student yet */
function showVotes($db, $studentId, $userId)
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
        showVoteForm($studentId, $userId);
    }
}

/* Shows the previous and next links (the link text is the student's college id).
   A link is left out if there is no student to link to. */
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

/* Get the student id from the URL (if there is one) */
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

    /* $student['id'] comes from the database and the user id from the session,
       so both are safe to use in the queries */
    showVotes($db, $student['id'], $_SESSION['userId']);

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
