<?php
/* getstudents.php
   Ajax helper script. It doesn't show a whole page, it only sends back the HTML
   for the list of students. The home page (index.php) puts this HTML into the page.
   Each student is shown as an avatar and student id that link to their student page. */

include "accessControl.php";
include "dbConnect.php";
include "voteDisplay.php";

/* Gets all the students, in order of id, together with their average vote
   and number of votes. A LEFT JOIN is used so students with no votes are
   still included (their average will be NULL). Returns the query result. */
function getAllStudents($db)
{
    $query = "SELECT c25a1_students.id AS s_id, image, c25a1_students.student_id,
              AVG(vote) AS average, COUNT(vote) AS count
              FROM c25a1_students LEFT JOIN c25a1_votes
              ON c25a1_students.id = c25a1_votes.student_id
              GROUP BY c25a1_students.id ORDER BY c25a1_students.id";

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

$result = getAllStudents($db);

while ($student = mysqli_fetch_array($result))
{
    echo makeStudentHtml($student);
}
?>
