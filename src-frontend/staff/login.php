<?php
$pageLevel = 0;
include("../backend/auth.php");
if ($_SERVER["REQUEST_METHOD"] == "GET") // Handle auth check
{
    if (isset($_COOKIE["id"]) && isset($_COOKIE["session"]))
    {
        $status = json_decode(isAuthenticated($pageLevel, $_COOKIE["id"], $_COOKIE["session"]));
        if ($status->status == "success")
            echo "<script>function auth(){window.location.replace('/staff');}</script>";
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>
    <?php include("../components/bootstrap.php"); ?>
</head>

<body style="background-color: #006335;" onload="auth()">
        <?php include("../components/navbar/navbar_login.php"); ?>
    <div class="container">

        <div class="box" style="width: 500px;
        height: 500px;
        margin: 50px auto auto auto;
        padding: 20px;
        background-color: #E5E9F2;
        border-radius: 5px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: center !important;">
            <div class="boxAfter" style="width: 100%;
            height: 100%;
            padding: 40px 50px 20px 50px ;
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center;
            margin: 0px !important;">
                <form action="/staff/login.php" method="POST" enctype="application/x-www-form-urlencoded">
                    <h1>Sign In</h1>
                    <h3>Welcome back to</h3>
                    <h3>Starbucks Dashboard!</h3>
                    <br /><br />
                    <!--Staff ID Number-->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="id" placeholder="Staff ID Number" />
                        </div>
                    </div>
                    <!--Password-->
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" name="pass" placeholder="Password" />
                        </div>
                        <!--Submit Button-->
                    </div>
                    <input type="hidden" name="level" value="0"/>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" style="width: 100%; background-color: #242625; border-color:#242625; font-weight: bold;" class="btn btn-primary">
                                Sign in
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>