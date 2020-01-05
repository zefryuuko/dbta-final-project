<?php
include("../backend/auth.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") // Handle auth check
{
    if (isset($_COOKIE["id"]) && isset($_COOKIE["session"]))
    {
        $status = json_decode(isAuthenticated($pageLevel, $_COOKIE["id"], $_COOKIE["session"]));
        if ($status->status == "failed")
            echo "<script>function auth(){alert('You are not authenticated to open this page.');window.location.replace('/cashier/login.php');}</script>";
    }
    else
    {
        echo "<script>function auth(){window.location.replace('/cashier/login.php');}</script>";
    }
}
$username = !empty($_GET["page"]);