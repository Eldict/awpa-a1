<?php
/* voteDisplay.php
   Helper functions for showing votes. Used by the student list (getstudents.php)
   and by the student page (student.php) so the votes look the same everywhere. */

/* Makes the text for a number of votes, with correct grammar:
   "No votes yet", "1 vote", "2 votes" ... */
function makeVoteCountText($count)
{
    if ($count == 0) return "No votes yet";

    if ($count == 1) return "1 vote";

    return $count . " votes";
}

/* Makes the HTML for the average vote, as that many star images.
   Returns an empty string if there is no average (nobody voted yet). */
function makeStarsHtml($average)
{
    $html = "";

    if ($average != NULL)
    {
        /* one star for each whole point of the average, rounded to the nearest
           (adding 0.5 means 1.5 or more counts as 2 stars) */
        for ($star = 1; $star <= $average + 0.5; $star++)
        {
            $html .= "<img src='images/star.svg' alt='star' width='20'>";
        }
    }

    return $html;
}
?>
