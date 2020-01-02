<?php
include("../backend/auth.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") // Handle auth check
{
    if (isset($_COOKIE["id"]) && isset($_COOKIE["session"]))
    {
        $status = json_decode(isAuthenticated($pageLevel, $_COOKIE["id"], $_COOKIE["session"]));
        if ($status->status == "failed")
            echo "<script>function auth(){alert('You are not authenticated to open this page.');window.location.replace('/staff/login.php');}</script>";
    }
    else
    {
        echo "<script>function auth(){window.location.replace('/staff/login.php');}</script>";
    }
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") // Handle authentication
{
    if (!empty($_POST["id"]) && !empty($_POST["pass"]))
    {
        $status = json_decode(authenticate($_POST["level"], $_POST["id"], md5($_POST["pass"])), true);
        if ($status["status"] == "success")
        {
            // Set cookie
            setcookie("id", $_POST["id"], time() + (86400 * 30), "/");
            setcookie("session", $status["session"], time() + (86400 * 30), "/");
            echo "<body onload=\"auth()\"><script>function auth(){window.location.replace('/staff');}</script>";
        }
        else
        {
            echo "<body onload=\"auth()\"><script>function auth(){alert('".$status["message"]."');window.location.replace('/staff/login.php');}</script>";
        }
    }
    else 
    {
        echo "<script>function auth(){alert('Incorrect ID and or password.');window.location.replace('/staff/login.php');}</script>";
    }
}
$username = !empty($_GET["page"]);