<?php
include_once("../backend/item.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") // Item Add
{
    if (!empty($_POST["add"]))
    {
      $status = addItem($_POST["item_name"], $_POST["item_size"], $_POST["item_price"]);
        if ($status["status"] == "success")
        {
            echo "<script>function item(){alert('Added item successfully.');window.location.replace('/staff/menu.php');}</script>";
        }
        else
        {
            echo "<script>function item(){alert('".$status["message"]."');window.location.replace('/staff/menu.php');}</script>";
        }
    }
    else if (!empty($_POST["item_name"]) && !empty($_POST["item_price"]))
    {
        $status = updateItem($_POST["item_id"], $_POST["item_name"], $_POST["item_size"], $_POST["item_price"]);
        if ($status["status"] == "success")
        {
            echo "<script>function item(){alert('Updated item successfully.');window.location.replace('/staff/menu.php');}</script>";
        }
        else
        {
            echo "<script>function item(){alert('".$status["message"]."');window.location.replace('/staff/menu.php');}</script>";
        }
    }
    else 
    {
        echo "<script>function item(){alert('Incorrect input.');window.location.replace('/staff/menu.php');}</script>";
    }
}
else  // Item deletion
{
    if (!empty($_GET["delete"]) && !empty($_GET["item_id"]))
    {
      removeItem($_GET["item_id"]);
      echo "<script>function item(){window.location.replace('/staff/menu.php');}</script>";
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
    <?php include("../components/bootstrap.php"); ?></script>
    <?php 
      $pageLevel = 0;
      include("auth.php");
    ?>
</head>

<body onload="try{auth()}catch(e){} item()">
        <?php include("../components/navbar/navbar_staff.php"); ?>
    <div class="container">
        <div class="bodyLeft">
            <nav class="navbar navbar-light" style="">
                <a class="navbar-brand" style="font-size:25px; font-weight: bold;">Items</a>
                <form class="form-inline" style="" action="/staff/menu.php">
                    <input class="form-control mr-sm-2" type="search" name="name" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-light btn-outline-dark my-2 my-sm-0" type="submit">
                        Search
                    </button>
                </form>
            </nav>

            <div class="table-responsive">
                <table class="table" style="">
                    <thead class="thead-dark" style="font-size: 20px">
                        <tr>
                            <th scope="col" style="width: 100px">ID</th>
                            <th scope="col" style="width: 250px">Item</th>
                            <th scope="col" style="width: 250px">Size</th>
                            <th scope="col" style="width: 170px;">Price</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 18px">
                    <?php include ("../components/modular/menu_staff.php");?>
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
        <div class="bodyRight" style="">
            <div class="box" style="width: 400px;
                    height: 450px;
                    padding: 40px;
                    border-radius: 5px;
                    tex t-align: center;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <form action="/staff/menu.php" method="POST">
                    <p style="font-size:25px; padding: 10px; font-weight: bold; margin-top:10px;">
                        Add Item
                    </p>
                    <input type="hidden" name="add" value="add"/>
                    <input class="form-control" type="text" name="item_name" placeholder="Item Name" style="padding: 10px;" />
                    <br />
                    <input class="form-control" type="number" name="item_price" placeholder="Price" style="padding: 10px;" />
                    <br />
                    <select class="form-control" name="item_size">
                        <option>Tall</option>
                        <option>Grande</option>
                        <option>Venti</option>
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