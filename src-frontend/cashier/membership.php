<?php
include_once("../backend/card.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") // Top up
{
    if (!empty($_POST["card_number"]) && !empty($_POST["topup_balance"]))
    {
      $status = topupCard($_POST["card_number"], $_POST["topup_balance"]);
        if ($status["status"] == "success")
        {
            echo "<script>function membership(){alert('Top up success.');window.location.replace('/cashier/membership.php');}</script>";
        }
        else
        {
            echo "<script>function membership(){alert('".$status["message"]."');window.location.replace('/cashier/membership.php');}</script>";
        }
    }
    else 
    {
        echo "<script>function membership(){alert('Incorrect input.');window.location.replace('/cashier/membership.php');}</script>";
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
    <?php include ("../components/bootstrap.php");?></script>
    <?php 
      $pageLevel = 1;
      include("auth.php");
      include("../backend/staff.php");
      $staffName = getStaffByID($_COOKIE["id"])[0]["staff_name"];
    ?>
    </head>

    <body onload="try{auth()}catch(e){} membership()">
    <div class="container">
      <?php include ("../components/navbar/navbar_cashier.php");?>
      <div class="bodyLeft">
        <nav
          class="navbar navbar-light"
          style=""
        >
          <a class="navbar-brand" style="font-size:25px; font-weight: bold;"
            >Membership</a
          >
          <form
            class="form-inline"
            style=""
            action="/cashier/membership.php"
          >
            <input
              class="form-control mr-sm-2"
              type="search"
              name="no"
              placeholder="Card Number"
              aria-label="Search"
            />
            <button
              class="btn btn-light btn-outline-dark my-2 my-sm-0"
              type="submit"
            >
              Search
            </button>
          </form>
        </nav>

        <div class="table-responsive">
          <table
            class="table"
            style=""
          >
            <thead class="thead-dark" style="font-size: 20px">
              <tr>
                <th scope="col" style="width: 250px">Number</th>
                <th scope="col" style="width: 350px">Name</th>
                <th scope="col" style="width: 300px">Balance</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody style="font-size: 18px">
            <?php include ("../components/modular/membership_cashier.php"); ?>
            <?php
                // Searching implementation
                if (!empty($_GET["no"]) ) generateTableBodyByNo($_GET["no"], !empty($_GET["page"]) ? $_GET["page"] : 1);
                else generateTableBody(!empty($_GET["page"]) ? $_GET["page"] : 1);
                ?>
          </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php
      // Modals
      if (!empty($_GET["no"])) generateModalsByNo($_GET["no"], !empty($_GET["page"]) ? $_GET["page"] : 1);
    ?>
  </body>
</html>
