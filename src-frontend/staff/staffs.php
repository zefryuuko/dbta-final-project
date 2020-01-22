<?php include("../components/modular/staff_details.php"); ?>
<?php
include_once("../backend/staff.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") // Staff Add
{
    if (!empty($_POST["add"]))
    {
      $status = addStaff($_POST["staff_name"], $_POST["staff_level"], $_POST["staff_password"]);
        if ($status["status"] == "success")
        {
            echo "<script>function staff(){alert('Added staff successfully.');window.location.replace('/staff/staffs.php');}</script>";
        }
        else
        {
            echo "<script>function staff(){alert('".$status["message"]."');window.location.replace('/staff/staffs.php');}</script>";
        }
    }
    else if (!empty($_POST["staff_name"]) && isset($_POST["staff_level"]))
    {
        $status = updateStaff($_POST["staff_id"], $_POST["staff_name"], $_POST["staff_level"], md5($_POST["staff_password"]));
        if ($status["status"] == "success")
        {
            echo "<script>function staff(){alert('Updated staff successfully.');window.location.replace('/staff/staffs.php');}</script>";
        }
        else
        {
            echo "<script>function staff(){alert('".$status["message"]."');window.location.replace('/staff/staffs.php');}</script>";
        }
    }
    else 
    {
        echo "<script>function staff(){alert('Incorrect input.".$_POST["staff_level"]."');window.location.replace('/staff/staffs.php');}</script>";
    }
}
else  // Staff deletion
{
    if (!empty($_GET["delete"]) && !empty($_GET["staff_id"]))
    {
      removeStaff($_GET["staff_id"]);
      echo "<script>function item(){window.location.replace('/staff/staffs.php');}</script>";
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
    <title>Staff - Dashboard</title>

    <?php include("../components/bootstrap.php"); ?>
    <?php 
      $pageLevel = 0;
      include("auth.php");
    ?>
</head>

<body onload="try{auth()}catch(e){} staff()">
    <?php include("../components/navbar/navbar_staff.php"); ?>
    <div class="container">
        <nav class="navbar navbar-light" style=" ">
                <a class="navbar-brand" style="font-size:25px; font-weight: bold;">Staff Details</a>
                <form class="form-inline" style="" action="/staff/staffs.php">
                    <input class="form-control mr-sm-2" type="search" name="name" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-light btn-outline-dark my-2 my-sm-0" type="submit">
                        Search
                    </button>
                </form>
            </nav>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark" style="font-size: 20px">
                    <tr>
                        <th scope="col" width="100px">ID</th>
                        <th scope="col" width="350px">Name</th>
                        <th scope="col" width="250px">Role</th>
                        <th scope="col" width="50px">Action</th>
                        <th scope="col" width="50px"></th>
                    </tr>
                </thead>
                <tbody style="font-size: 18px">
                <?php
                        // Searching implementation
                        if (!empty($_GET["name"]) ) generateTableBodyByName($_GET["name"], !empty($_GET["page"]) ? $_GET["page"] : 1);
                        else generateTableBody(!empty($_GET["page"]) ? $_GET["page"] : 1);
                    ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if (empty($_GET["name"])) generatePagination(!empty($_GET["page"]) ? $_GET["page"] : 1) ?>
            </ul>
        </nav>
        <div class="bodyRight" style="">
            <div class="box" style="width: 400px;
                    height: 450px;
                    padding: 40px;
                    border-radius: 5px;
                    tex t-align: center;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <form action="/staff/staffs.php" method="POST">
                    <p style="font-size:25px; padding: 10px; font-weight: bold; margin-top:10px;">
                        Add Staff
                    </p>
                    <input type="hidden" name="add" value="add"/>
                    <input class="form-control" type="text" name="staff_name" placeholder="Staff Name" style="padding: 10px;" />
                    <br />
                    <input class="form-control" type="password" name="staff_password" placeholder="Staff Password" style="padding: 10px;" />
                    <br />
                    <select class="form-control" name="staff_level">
                    <option value="0">Admin</option>
                    <option selected="" value="1">Cashier</option>
                    </select>

                    <br /><br />
                    <button type="submit" style="width: 100%; background-color: #242625; border-color:#242625; font-weight: bold; padding: 10px;" class="btn btn-primary">
                        Add Item
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php
      // Modals
      if (!empty($_GET["name"])) generateModalsByName($_GET["name"], !empty($_GET["page"]) ? $_GET["page"] : 1);
      else generateModals(!empty($_GET["page"]) ? $_GET["page"] : 1);
    ?>
</body>

</html>