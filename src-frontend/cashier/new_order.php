<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>

    <?php include("../components/bootstrap.php"); ?>
    <?php 
      $pageLevel = 1;
      include("auth.php");
      include("../backend/staff.php");
      $staffName = getStaffByID($_COOKIE["id"])[0]["staff_name"];
    ?>
    </head>

    <body onload="try{auth()}catch(e){}">
    <div class="container">
        <?php include("../components/navbar/navbar_cashier.php"); ?>

        <div class="bodyLeft" style="float:left; ">
        <p style="font-size:25px; margin-top:13px; font-weight: bold;">
                Current Transaction
            </p>
            <div class="table-responsive">
                <table class="table" style="width: 550px; float: left;">
                    <thead class="thead-dark" style="font-size: 20px">
                        <tr>
                            <th scope="col" style="width: 40px">#</th>
                            <th scope="col" style="width: 80px">Item</th>
                            <th scope="col" style="width: 50px">Quantity</th>
                            <th scope="col" style="width: 70px">Size</th>
                            <th scope="col" style="width: 140px">Price</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 18px">
                        <?php include("../components/modular/new_order.php"); ?>
                    </tbody>
                </table>
            </div>
            <!--Order Table-->

            <br /><br />

            <div class="table-responsive">
            <table class="table" style="width: 550px; float: left;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="width: 240px; font-size: 25px; font-weight: bold;">
                                Sub Total:
                            </th>
                            <th scope="col" style=" font-size: 25px; font-weight: bold;">
                                Rp xxx.xxx.xxx
                            </th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!--Subtotal table-->

            <button type="button" href="/cashier/checkout.php" class="btn btn-light btn-primary btn-lg btn-outline-dark" style="width: 60%">
                Close Order
            </a>

            <button type="button" onclick="window.location.replace('/cashier/index.php')" class="btn btn-danger btn-lg" style="margin-left:22px; width: 35%">
                Cancel Order
            </a>
        </div>
        <!--End of Left Body-->

        <div class="bodyRight" style="float:right;">
        <nav class="navbar navbar-light" style="font-size:25px; padding: 10px; font-weight: bold; ">
                <a class="navbar-brand">Items</a>
                <form class="form-inline" style="">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-light btn-outline-dark my-2 my-sm-0" type="submit">
                        Search
                    </button>
                </form>
            </nav>

            <div class="table-responsive">
            <table class="table" style="width: 450px; float: left; margin-top: 5px;">
                    <thead class="thead-dark" style="font-size: 20px">
                        <tr>
                            <th scope="col" style="width: 100px">Item ID</th>
                            <th scope="col" style="width: 100px">Item</th>
                            <th scope="col" style="width: 150px">Price</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 18px">
                        <?php include("../components/modular/menu_order.php"); ?>
                        <?php include("../components/modular/menu_order.php"); ?>
                        <?php include("../components/modular/menu_order.php"); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--End of Right Body-->
    </div>
</body>

</html>