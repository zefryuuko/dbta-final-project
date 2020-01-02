<?php
include_once("../backend/card.php");

function getRandomNumber($len = "16")
{
    $better_token = $code=sprintf("%0".$len."d", mt_rand(1, str_pad("", $len,"9")));
    return $better_token;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") // Membership Registration
{
    if (!empty($_POST["card_number"]))
    {
      $status = updateCard($_POST["card_number"], $_POST["cardholder_name"], $_POST["card_balance"]);
        if ($status["status"] == "success")
        {
            echo "<script>function membership(){alert('Updated member successfully.');window.location.replace('/staff/membership.php');}</script>";
        }
        else
        {
            echo "<script>function membership(){alert('".$status["message"]."');window.location.replace('/staff/membership.php');}</script>";
        }
    }
    else if (!empty($_POST["name"]) && !empty($_POST["balance"]))
    {
        $status = addCard("task=add&no=".getRandomNumber()."&name=".$_POST["name"]."&balance=".$_POST["balance"]);
        if ($status["status"] == "success")
        {
            // 
            echo "<script>function membership(){alert('Added member successfully.');window.location.replace('/staff/membership.php');}</script>";
        }
        else
        {
            echo "<script>function membership(){alert('".$status["message"]."');window.location.replace('/staff/membership.php');}</script>";
        }
    }
    else 
    {
        echo "<script>function membership(){alert('Incorrect input.');window.location.replace('/staff/membership.php');}</script>";
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
      $pageLevel = 0;
      include("auth.php");
    ?>
</head>

<body onload="try {auth()}catch(e){} membership();">
    <div class="container">
      <?php include ("../components/navbar/navbar_staff.php");?>
      <div class="bodyLeft" >
        <nav
          class="navbar navbar-light"
          style="width: 650px;padding: 10px; margin-left: 45px; margin-top:20px; margin-bottom: 16px;"
        >
          <a class="navbar-brand" style="font-size:25px; font-weight: bold;"
            >Membership</a
          >
          <form
            class="form-inline"
            style="margin-top: 10px; margin-right: 80px;"
            action="membership.php" method="GET" enctype="application/x-www-form-urlencoded"
          >
            <input
              class="form-control mr-sm-2"
              type="search"
              name="name"
              placeholder="Search"
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
                <th scope="col" style="width: 200px">Card Number</th>
                <th scope="col" style="width: 300px">Name</th>
                <th scope="col" style="width: 200px">Balance</th>
                <th scope="col" style="width: 10px"></th>
                <th scope="col" style="width: 10px"></th>
              </tr>
            </thead>
            <tbody style="font-size: 18px">
            <?php include ("../components/modular/membership_staff.php"); ?>
            <?php
                // Searching implementation
                if (!empty($_GET["name"]) ) generateTableBodyByName($_GET["name"], !empty($_GET["page"]) ? $_GET["page"] : 1);
                else generateTableBody(!empty($_GET["page"]) ? $_GET["page"] : 1);
                ?>
          </tbody>
          </table>
        </div>
      </div>
      <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if (empty($_GET["name"])) generatePagination(!empty($_GET["page"]) ? $_GET["page"] : 1) ?>
            </ul>
        </nav>
      <div
        class="bodyRight"
        style="margin-top: 30px;"
      >
        <div
          class="box"
          style="width: 400px;
                height: 450px;
                padding: 40px;
                margin-top: 20px;
                border-radius: 5px;
                text-align: center;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"
        >
          <p
            style="font-size:25px; padding: 10px; font-weight: bold; margin-top:10px;"
          >
            Add Member
          </p>
          <form action="/staff/membership.php" method="POST">
          <input
            class="form-control"
            type="text"
            name="name"
            placeholder="Card Holder Name"
            style="padding: 10px;"
          />
          <br />
          <input
            class="form-control"
            type="text"
            name="balance"
            placeholder="Starting Balance"
            style="padding: 10px;"
          />
          <br />

          <br /><br /><br />
          <button
            type="submit"
            style="width: 100%; background-color: #242625; border-color:#242625; font-weight: bold; padding: 10px;"
            class="btn btn-primary"
          >
            Add Member
          </button>
          </form>
        </div>
      </div>
    </div>
    <?php
      // Modals
      if (!empty($_GET["name"])) generateModalsByName($_GET["name"], !empty($_GET["page"]) ? $_GET["page"] : 1);
      else generateModals(!empty($_GET["page"]) ? $_GET["page"] : 1);
    ?>
  </body>
</html>
