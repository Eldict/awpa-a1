<?php
// voteDisplay.php
// functions for showing votes, used by getstudents.php and student.php

// text for the vote count
function makeVoteCountText($count)
{
    if ($count == 0) return "No votes yet";

    if ($count == 1) return "1 vote";

    return $count . " votes";
}

// stars for the average vote, nothing if no votes
function makeStarsHtml($average)
{
    $html = "";

    if ($average != NULL)
    {
        // + 0.5 to round to the nearest star
        for ($star = 1; $star <= $average + 0.5; $star++)
        {
            $html .= "<img src='images/star.svg' alt='star' width='20'>";
        }
    }

    return $html;
}
?>
