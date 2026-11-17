<?php
/* getstudents.php
   Ajax helper script. It doesn't show a whole page, it only sends back the HTML
   for the list of students. The home page (index.php) puts this HTML into the page.
   Each student is shown as an avatar and student id that link to their student page. */

include "accessControl.php";
include "dbConnect.php";

/* Gets all the students, in order of id. Returns the query result. */
function getAllStudents($db)
{
    $query = "SELECT id, image, student_id FROM c25a1_students ORDER BY id";

    return mysqli_query($db, $query);
}

/* Makes the HTML for one student: the avatar and student id, both inside a link
   to that student's page. */
function makeStudentHtml($student)
{
    $html = "<div>";
    $html .= "<a href='student.php?id=" . $student['id'] . "'>";
    $html .= "<img src='avatars/" . $student['image'] . "' alt='Student " . $student['student_id'] . "' width='100'>";
    $html .= "<br>" . $student['student_id'];
    $html .= "</a>";
    $html .= "</div>";

    return $html;
}

$result = getAllStudents($db);

while ($student = mysqli_fetch_array($result))
{
    echo makeStudentHtml($student);
}
?>
