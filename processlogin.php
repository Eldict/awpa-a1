<?php
// processlogin.php
// checks the login and password from login.php
// if correct save user in session and go to home page
// if wrong show error

session_start();
include "dbConnect.php";

// find the user with this login and password
function findUser($db, $login, $password)
{
    $safeLogin = mysqli_real_escape_string($db, $login);
    $safePassword = mysqli_real_escape_string($db, $password);

    $query = "SELECT id, name FROM c25a1_users
              WHERE login = '$safeLogin' AND password = '$safePassword'";

    $result = mysqli_query($db, $query);

    return mysqli_fetch_array($result);
}

// save the user in the session
function logUserIn($user)
{
    $_SESSION['loggedin'] = true;
    $_SESSION['userId'] = $user['id'];
    $_SESSION['userName'] = $user['name'];
}

// show error for wrong login
function showLoginError()
{
    echo "<h1>Login failed</h1>";
    echo "<p>Your login or password was incorrect.</p>";
    echo "<p><a href='login.php'>Back to the login page</a></p>";
}

// if the form wasn't sent I go back to the login page
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
