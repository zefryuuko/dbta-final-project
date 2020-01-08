<?php
include_once("../backend/branch.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") // Branch Add
{
    if (!empty($_POST["add"]))
    {
      $status = addBranch($_POST["branch_name"], $_POST["branch_phone"]);
        if ($status["status"] == "success")
        {
            echo "<script>function branch(){alert('Added branch successfully.');window.location.replace('/staff/branch.php');}</script>";
        }
        else
        {
            echo "<script>function branch(){alert('".$status["message"]."');window.location.replace('/staff/branch.php');}</script>";
        }
    }
    else if (!empty($_POST["branch_name"]) && !empty($_POST["branch_phone"]))
    {
        $status = updateBranch($_POST["branch_id"], $_POST["branch_name"], $_POST["branch_phone"]);
        if ($status["status"] == "success")
        {
            echo "<script>function branch(){alert('Updated branch successfully.');window.location.replace('/staff/branch.php');}</script>";
        }
        else
        {
            echo "<script>function branch(){alert('".$status["message"]."');window.location.replace('/staff/branch.php');}</script>";
        }
    }
    else 
    {
        echo "<script>function branch(){alert('Incorrect input.');window.location.replace('/staff/branch.php');}</script>";
    }
}
else  // Branch deletion
{
    if (!empty($_GET["delete"]) && !empty($_GET["branch_id"]))
    {
      removeBranch($_GET["branch_id"]);
      echo "<script>function branch(){window.location.replace('/staff/branch.php');}</script>";
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
    <title>Branch - Dashboard</title>
    <?php include ("../components/bootstrap.php");?></script>
    <?php 
      $pageLevel = 0;
      include("auth.php");
    ?>
</head>

<body onload="try {auth()}catch(e){} branch()">
      <?php include ("../components/navbar/navbar_staff.php");?>
    <div class="container">
      <div class="bodyLeft">
        <nav
          class="navbar navbar-light"
          style=""
        >
          <a class="navbar-brand" style="font-size:25px; font-weight: bold;"
            >Branch</a
          >
          <form action="/staff/branch.php" method="GET"
            class="form-inline"
            style=""
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
                <th scope="col" style="width: 70px">ID</th>
                <th scope="col" style="width: 250px">Name</th>
                <th scope="col" style="width: 250px">Telephone</th>
                <th scope="col" style="width: 25px"></th>
                <th scope="col" style="width: 25px"></th>
              </tr>
            </thead>
            <tbody style="font-size: 18px">
            <?php include ("../components/modular/branch.php");?>
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
        style=" margin-top: 30px;"
      >
        <div
          class="box"
          style="width: 400px;
                height: 450px;
                padding: 40px;
                border-radius: 5px;
                text-align: center;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"
        >
          <p
            style="font-size:25px; padding: 10px; font-weight: bold; margin-top:10px;"
          >
            Add Branch
          </p>
          <form action="/staff/branch.php" method="POST">
              <input type="hidden" name="add" value="add"/>
              <input
                class="form-control"
                type="text"
                name="branch_name"
                placeholder="Branch Name"
                style="padding: 10px;"
              />
              <br />
              <input
                class="form-control"
                type="text"
                name="branch_phone"
                placeholder="Branch Telephone"
                style="padding: 10px;"
              />
              <br />

              <br /><br /><br />
              <button
                type="submit"
                style="width: 100%; background-color: #242625; border-color:#242625; font-weight: bold; padding: 10px;"
                class="btn btn-primary"
              >
                Add Item
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
