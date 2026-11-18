<?php
/* getstat.php
   Ajax helper script. It sends back only the total number of votes in the
   database. The home page (index.php) asks for it every 2 seconds. */

include "accessControl.php";
include "dbConnect.php";

/* Gets the total number of votes from the votes table */
function getTotalVotes($db)
{
    $query = "SELECT COUNT(vote) AS count FROM c25a1_votes";

    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);

    return $row['count'];
}

echo getTotalVotes($db);
?>
