<?php
include_once("../backend/discount.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") // Branch Add
{
    if (!empty($_POST["add"]))
    {
      $status = addDiscount($_POST["discount_name"], $_POST["discount_percentage"]);
        if ($status["status"] == "success")
        {
            echo "<script>function discount(){alert('Added discount successfully.');window.location.replace('/staff/discounts.php');}</script>";
        }
        else
        {
            echo "<script>function discount(){alert('".$status["message"]."');window.location.replace('/staff/discounts.php');}</script>";
        }
    }
    else if (!empty($_POST["discount_name"]) && !empty($_POST["discount_percentage"]))
    {
        $status = updateDiscount($_POST["discount_id"], $_POST["discount_name"], $_POST["discount_percentage"]);
        if ($status["status"] == "success")
        {
            echo "<script>function discount(){alert('Updated discount successfully.');window.location.replace('/staff/discounts.php');}</script>";
        }
        else
        {
            echo "<script>function discount(){alert('".$status["message"]."');window.location.replace('/staff/discounts.php');}</script>";
        }
    }
    else 
    {
        echo "<script>function discount(){alert('Incorrect input.');window.location.replace('/staff/discounts.php');}</script>";
    }
}
else  // Branch deletion
{
    if (!empty($_GET["delete"]) && !empty($_GET["discount_id"]))
    {
      removeDiscount($_GET["discount_id"]);
      echo "<script>function discount(){window.location.replace('/staff/discounts.php');}</script>";
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

<body onload="try {auth()}catch(e){} discount()">
    <div class="container">
      <?php include ("../components/navbar/navbar_staff.php");?>
      <div class="bodyLeft">
        <nav
          class="navbar navbar-light"
          style=""
        >
          <a class="navbar-brand" style="font-size:25px; font-weight: bold;"
            >Discounts</a
          >
          <form action="/staff/discounts.php" method="GET"
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
                <th scope="col" style="width: 250px">Discount Name</th>
                <th scope="col" style="width: 250px">Percentage</th>
                <th scope="col" style="width: 25px"></th>
                <th scope="col" style="width: 25px"></th>
              </tr>
            </thead>
            <tbody style="font-size: 18px">
            <?php include ("../components/modular/discounts_staff.php");?>
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
            Add Discount
          </p>
          <form action="/staff/discounts.php" method="POST">
              <input type="hidden" name="add" value="add"/>
              <input
                class="form-control"
                type="text"
                name="discount_name"
                placeholder="Discount Name"
                style="padding: 10px;"
              />
              <br />
              <input
                class="form-control"
                type="number"
                name="discount_percentage"
                placeholder="Discount Percentage"
                style="padding: 10px;"
              />
              <br />

              <br /><br /><br />
              <button
                type="submit"
                style="width: 100%; background-color: #242625; border-color:#242625; font-weight: bold; padding: 10px;"
                class="btn btn-primary"
              >
                Add Discount
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

      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#exampleModal"
      >
        Launch demo modal
      </button>

      <!-- Modal -->
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h3
                class="modal-title"
                id="exampleModalLabel"
                style="text-align: center;"
              >
                Discounts
              </h3>
              <br>
              <div class="table-responsive">
                <table
                  class="table"
                style="width: 400px; float: left; margin-left: 40px;"
                >
                  <thead class="thead-dark" style="font-size: 20px">
                    <tr>
                      <th scope="col" style="width: 80px">ID</th>
                      <th scope="col" style="width: 100px">Name</th>
                      <th scope="col" style="width: 150px">Percentage</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody style="font-size: 18px">
                    <?php include("../components/modular/discounts.php"); ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer" style="margin: auto;">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                style="width: 150px;"
              >
                Cancel
              </button>
              <button
                type="button"
                class="btn btn-danger"
                style="width: 150px;"
              >
                Done
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
