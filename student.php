<?php
/* student.php
   Shows the details of one student.
   The id of the student (the id field in c25a1_students) is passed in the URL,
   e.g. student.php?id=3 */

include "accessControl.php";
include "dbConnect.php";

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
}
else
{
    echo "<h1>Student not found</h1>";
}

include "footer.php";
?>

</body>
</html>
