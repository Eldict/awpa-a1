<?php
/* getstudents.php
   Ajax helper script. It doesn't show a whole page, it only sends back the HTML
   for the list of students. The home page (index.php) puts this HTML into the page.
   Each student is shown as an avatar and student id that link to their student page.
   The order and direction of the list come from the URL, e.g.
   getstudents.php?order=average&direction=desc
   order can be: id (default), average, count
   direction can be: asc (default), desc */

include "accessControl.php";
include "dbConnect.php";
include "voteDisplay.php";

/* Turns the order from the URL into the SQL to sort by.
   Only the values listed here are allowed, so nothing from the URL is put into
   the query directly. Anything unknown sorts by id. */
function getOrderSql($order)
{
    if ($order == "average") return "AVG(vote)";

    if ($order == "count") return "COUNT(vote)";

    return "c25a1_students.id";
}

/* Turns the direction from the URL into ASC or DESC (default ASC) */
function getDirectionSql($direction)
{
    if ($direction == "desc") return "DESC";

    return "ASC";
}

/* Gets all the students together with their average vote and number of votes,
   sorted as asked. A LEFT JOIN is used so students with no votes are
   still included (their average will be NULL). Returns the query result. */
function getAllStudents($db, $order, $direction)
{
    $orderSql = getOrderSql($order);
    $directionSql = getDirectionSql($direction);

    $query = "SELECT c25a1_students.id AS s_id, image, c25a1_students.student_id,
              AVG(vote) AS average, COUNT(vote) AS count
              FROM c25a1_students LEFT JOIN c25a1_votes
              ON c25a1_students.id = c25a1_votes.student_id
              GROUP BY c25a1_students.id ORDER BY $orderSql $directionSql";

    return mysqli_query($db, $query);
}

/* Makes the HTML for one student: the avatar and student id, both inside a link
   to that student's page, then their average vote (stars) and number of votes. */
function makeStudentHtml($student)
{
    $html = "<div>";
    $html .= "<a href='student.php?id=" . $student['s_id'] . "'>";
    $html .= "<img src='avatars/" . $student['image'] . "' alt='Student " . $student['student_id'] . "' width='100'>";
    $html .= "<br>" . $student['student_id'];
    $html .= "</a>";
    $html .= "<br>" . makeStarsHtml($student['average']);
    $html .= "<br>" . makeVoteCountText($student['count']);
    $html .= "</div>";

    return $html;
}

/* Get the order and direction from the URL (if they are there) */
$order = "id";
if (isset($_GET["order"])) $order = $_GET["order"];

$direction = "asc";
if (isset($_GET["direction"])) $direction = $_GET["direction"];

$result = getAllStudents($db, $order, $direction);

while ($student = mysqli_fetch_array($result))
{
    echo makeStudentHtml($student);
}
?>
