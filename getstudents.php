<?php
// getstudents.php
// ajax script, sends back the html for the student list
// index.php puts this into the page
// order = id, average or count
// direction = asc or desc

include "accessControl.php";
include "dbConnect.php";
include "voteDisplay.php";

// get the sql for the order, only these 3 are allowed
function getOrderSql($order)
{
    if ($order == "average") return "AVG(vote)";

    if ($order == "count") return "COUNT(vote)";

    return "c25a1_students.id";
}

// get ASC or DESC
function getDirectionSql($direction)
{
    if ($direction == "desc") return "DESC";

    return "ASC";
}

// get all students with their average vote and vote count
// LEFT JOIN so students with no votes still show up
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

// make the html for one student, avatar and id link to the student page
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

// order and direction from the url
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
