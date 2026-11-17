<?php
/* processlogin.php
   Receives the login and password from login.php (POST) and checks them
   against the c25a1_users table.
   - Details correct: save the user in the session and go to the home page.
   - Details wrong: show an error message with a link back to the login page. */

session_start();
include "dbConnect.php";

/* Looks for a user with this login and password.
   Returns that user's row, or false if there is no match. */
function findUser($db, $login, $password)
{
    /* escape the text so it can't break the SQL query */
    $safeLogin = mysqli_real_escape_string($db, $login);
    $safePassword = mysqli_real_escape_string($db, $password);

    $query = "SELECT id, name FROM c25a1_users
              WHERE login = '$safeLogin' AND password = '$safePassword'";

    $result = mysqli_query($db, $query);

    /* only one row expected, so no loop needed */
    return mysqli_fetch_array($result);
}

/* Saves the user's details in the session so other pages know they are logged in. */
function logUserIn($user)
{
    $_SESSION['loggedin'] = true;
    $_SESSION['userId'] = $user['id'];
    $_SESSION['userName'] = $user['name'];
}

/* Show the error page for wrong details */
function showLoginError()
{
    echo "<h1>Login failed</h1>";
    echo "<p>Your login or password was incorrect.</p>";
    echo "<p><a href='login.php'>Back to the login page</a></p>";
}

/* If someone opens this page without sending the form, just send them to the login page */
if (!isset($_POST['login']) || !isset($_POST['password']))
{
    header("Location:login.php");
    exit();
}

$user = findUser($db, $_POST['login'], $_POST['password']);

if ($user)
{
    logUserIn($user);
    header("Location:index.php");
    exit();
}
else
{
    showLoginError();
}
?>
