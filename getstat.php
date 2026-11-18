<?php
// getstat.php
// ajax script, sends back the total number of votes
// index.php calls this every 2 seconds

include "accessControl.php";
include "dbConnect.php";

// get the total number of votes
function getTotalVotes($db)
{
    $query = "SELECT COUNT(vote) AS count FROM c25a1_votes";

    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);

    return $row['count'];
}

echo getTotalVotes($db);
?>
